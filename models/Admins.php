<?php

namespace app\models;

use app\models\queries\AdminsQuery;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\web\IdentityInterface;
use Yii;

use app\common\helpers\validators\UniqueValidator;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\SafeValidator;
/**
 * Таблица пользователей, в нашем случае - админов сайта
 * Есть значительное количество рудиментарных полей в таблице
 *
 * This is the model class for table "admins".
 *
 * @property int $id             - id Primary Key
 * @property int $banned         - Флаг бана пользователя
 * @property string $user        - Логин пользователя, в переводе назван почтой
 * @property string $password    - Пароль пользователя
 * @property string $captcha     - Гугл капча
 * @property int $remember_me    - Флаг запомнить меня
 * @property string $role        - Роль пользователя
 * @property string $name        - Имя пользователя
 * @property string $date_end    - Дата окончания прав учетной записи
 * @property string $bann_reason - Причина блокировки
 * @property string|null $newPassword - Новый пароль в открытом виде (только из формы в админке, в БД не хранится)
 */
class Admins extends ActiveRecord implements IdentityInterface
{
    /** @var string - Константа, название таблицы */
    public const TABLE_NAME = 'admins';

    /** Константы атрибутов Active Record модели */
    public const ATTR_ID          = 'id';
    public const ATTR_BANNED      = 'banned';
    public const ATTR_USER        = 'user';
    public const ATTR_PASSWORD    = 'password';
    public const ATTR_CAPTCHA     = 'captcha';
    public const ATTR_REMEMBER_ME = 'remember_me';
    public const ATTR_ROLE        = 'role';
    public const ATTR_NAME        = 'name';
    public const ATTR_DATE_END    = 'date_end';
    public const ATTR_BANN_REASON = 'bann_reason';

    /** Константы True/False для различных поисков */
    public const TRUE  = 1;
    public const FALSE = 0;

    /** Константы True/False для проверки, забанен пользователь или нет */
    public const ATTR_BANNED_TRUE = 1;
    public const ATTR_BANNED_FALSE = 0;

    /** Виртуальный атрибут - новый пароль в открытом виде, хешируется в beforeSave() */
    public const ATTR_NEW_PASSWORD = 'newPassword';

    /** Сценарии формы в админке - в них хеш пароля напрямую не принимается, только newPassword */
    public const SCENARIO_CREATE = 'create';
    public const SCENARIO_UPDATE = 'update';

    /** Ограничения длины пароля (72 - предел bcrypt, дальше символы игнорируются) */
    public const PASSWORD_MIN_LENGTH = 8;
    public const PASSWORD_MAX_LENGTH = 72;

    /** @var string|null - Новый пароль из формы в админке */
    public $newPassword;

    /**
     * Имя таблицы в БД
     *
     * @return string
     */
    public static function tableName(): string
    {
        return 'admins';
    }

    /**
     * Массив валидаций этой модели
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_USER, RequiredValidator::class],
            [static::ATTR_USER, UniqueValidator::class, UniqueValidator::ATTR_MESSAGE => 'Логин пользователя должен быть уникальным.'],
            [static::ATTR_USER, StringValidator::class, StringValidator::ATTR_MAX => 45],

            /** Хеш пароля - задается напрямую только вне формы админки (миграции, тесты, консоль) */
            [static::ATTR_PASSWORD, RequiredValidator::class, 'except' => [static::SCENARIO_CREATE, static::SCENARIO_UPDATE]],
            [static::ATTR_PASSWORD, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH, 'except' => [static::SCENARIO_CREATE, static::SCENARIO_UPDATE]],

            /** Новый пароль из формы: обязателен при создании, при редактировании - пусто значит не менять */
            [static::ATTR_NEW_PASSWORD, RequiredValidator::class, RequiredValidator::ATTR_ON => static::SCENARIO_CREATE],
            [
                static::ATTR_NEW_PASSWORD,
                StringValidator::class,
                StringValidator::ATTR_MIN => static::PASSWORD_MIN_LENGTH,
                StringValidator::ATTR_MAX => static::PASSWORD_MAX_LENGTH,
                StringValidator::ATTR_ON => [static::SCENARIO_CREATE, static::SCENARIO_UPDATE]
            ],

            [static::ATTR_NAME, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_NAME, SafeValidator::class],

            [static::ATTR_ROLE, StringValidator::class],
            [static::ATTR_ROLE, SafeValidator::class],

            [static::ATTR_REMEMBER_ME, IntegerValidator::class],
            [static::ATTR_REMEMBER_ME, SafeValidator::class],

            [static::ATTR_BANNED, IntegerValidator::class],

            [static::ATTR_CAPTCHA, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_CAPTCHA, SafeValidator::class],

            [static::ATTR_BANN_REASON, StringValidator::class],
            [static::ATTR_BANN_REASON, SafeValidator::class]
        ];
    }

    /**
     * Переводы полей таблицы
     *
     * @return array|string[]
     */
    public function attributeLabels(): array
    {
        return [
            static::ATTR_ID => 'ID',
            static::ATTR_USER => 'Логин пользователя',
            static::ATTR_PASSWORD => 'Пароль пользователя',
            static::ATTR_CAPTCHA => 'Captcha',
            static::ATTR_REMEMBER_ME => 'Remember Me',
            static::ATTR_ROLE => 'Роль',
            static::ATTR_DATE_END => 'Дата окончания учетной записи',
            static::ATTR_NAME => 'Имя пользователя учетной записи',
            static::ATTR_BANNED => 'Забанен',
            static::ATTR_BANN_REASON => 'Причина блокировки',
            static::ATTR_NEW_PASSWORD => 'Новый пароль'
        ];
    }

    /**
     * Проверяем пароль: новые хеши (bcrypt) через Yii security, старые sha1 - для обратной совместимости
     *
     * @param string $password - Пароль в открытом виде
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        /** Старый формат - sha1 без соли (сравнение через hash_equals - защита от атак по времени) */
        if ($this->isLegacyPasswordHash()) {
            return hash_equals((string) $this->password, sha1($password));
        }

        try {
            /** Новый формат - bcrypt */
            return Yii::$app->security->validatePassword($password, (string) $this->password);
        } catch (InvalidArgumentException $e) {

            /** Пустой пароль или битый хеш в БД - считаем что пароль неверный */
            return false;
        }
    }

    /**
     * Хранится ли пароль в старом формате (sha1 - 40 hex символов)
     *
     * @return bool
     */
    public function isLegacyPasswordHash(): bool
    {
        return (bool) preg_match('/^[a-f0-9]{40}$/i', (string) $this->password);
    }

    /**
     * Сетапим новый пароль - в атрибут записывается только хеш
     *
     * @param string $password - Пароль в открытом виде
     * @return void
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Перед сохранением: хешируем новый пароль из формы и приводим поля формы к формату БД
     *
     * @param bool $insert
     * @return bool
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        /** Если в форме ввели новый пароль - хешируем его */
        if ($this->newPassword !== null && $this->newPassword !== '') {
            $this->setPassword($this->newPassword);
        }

        /** Поля, которые приходят из формы админки */
        if (in_array($this->scenario, [static::SCENARIO_CREATE, static::SCENARIO_UPDATE], true)) {

            /** В БД "не забанен" хранится как NULL (см. unbannedUsers()), а чекбокс присылает 0 */
            $this->banned = $this->banned ? static::ATTR_BANNED_TRUE : null;
        }

        /** Колонка captcha - NOT NULL без значения по умолчанию, рудимент */
        if ($insert && $this->captcha === null) {
            $this->captcha = '';
        }

        return true;
    }

    /**
     * Находим identity по id параметру
     *
     * @param int|string $id
     * @return static|null - null, если пользователь не найден (например, удален, а сессия осталась)
     */
    public static function findIdentity($id): ?self
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
    }

    /**
     * Get it of this object model
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        //return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        //return $this->authKey === $authKey;
    }

    /**
     * Получаем всех незабаненных пользователей в виде объектов кроме себя
     *
     * @return array|bool|ActiveRecord[]
     */
    public function unbannedUsers()
    {
        if (isset(Yii::$app->user->identity->id)) {
            return static::find()
                ->where(['is', static::ATTR_BANNED, null])
                ->andWhere(['!=', static::ATTR_ID, Yii::$app->user->identity->id])
                ->all();
        } else {
            return false;
        }
    }

    /**
     * Получаем общее количество пользователей в системе
     *
     * @return int
     */
    public function UsersCount(): int
    {
       return static::find()->count();
    }

    /**
     * Получаем количество забаненных пользователей
     *
     * @return int
     */
    public function bannedUsers(): int
    {
        return static::find()->where([static::ATTR_BANNED => static::TRUE])->count();
    }

    /**
     * Получаем всех пользователей сайта в виде массива
     *
     * @return array
     */
    public function takeAllUsers(): array
    {
        return static::find()->asArray()->all();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return AdminsQuery
     */
    public static function find(): AdminsQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new AdminsQuery(get_called_class());
    }
}