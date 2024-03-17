<?php

namespace app\models;

use app\models\queries\AdminsQuery;
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

            [static::ATTR_PASSWORD, RequiredValidator::class],
            [static::ATTR_PASSWORD, StringValidator::class, StringValidator::ATTR_MAX => 45],

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
            static::ATTR_BANN_REASON => 'Причина блокировки'
        ];
    }

    /**
     * Валидируем пароль
     *
     * @param $password
     * @return bool
     */
    public function validatePassword($password): bool
    {
        return $this->password == md5($password);
    }

    /**
     * Находим identity по id параметру
     *
     * @param int|string $id
     * @return BaseActiveRecord
     */
    public static function findIdentity($id): BaseActiveRecord
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