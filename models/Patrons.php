<?php

namespace app\models;

use app\common\helpers\validators\IntegerValidator;
use app\models\queries\PatronsQuery;
use Yii;

use app\common\helpers\validators\StringValidator;

use yii\db\ActiveRecord;
/**
 * This is the model class for table "patrons".
 *
 * @property int $id
 * @property string $caliber
 * @property string $type
 * @property string $damage
 * @property string $probitie
 * @property string $damage_per_defence
 * @property string $speed
 * @property string $count
 * @property string $tochn
 * @property string $otdacha
 * @property string $fragmentation
 * @property string $blood_1
 * @property string $blood_2
 * @property string $rikochet
 * @property string $traccer
 */
class Patrons extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID                 = 'id';
    public const ATTR_CALIBER            = 'caliber';
    public const ATTR_TYPE               = 'type';
    public const ATTR_DAMAGE             = 'damage';
    public const ATTR_PROBITIE           = 'probitie';
    public const ATTR_DAMAGE_PER_DEFENCE = 'damage_per_defence';
    public const ATTR_SPEED              = 'speed';
    public const ATTR_COUNT              = 'count';
    public const ATTR_TOCHN              = 'tochn';
    public const ATTR_OTDACHA            = 'otdacha';
    public const ATTR_FRAGMENTATION      = 'fragmentation';
    public const ATTR_BLOOD_1            = 'blood_1';
    public const ATTR_BLOOD_2            = 'blood_2';
    public const ATTR_RIKOCHET           = 'rikochet';
    public const ATTR_TRACCER            = 'traccer';
    public const ATTR_YB                 = 'yb';

    /**
     * Имя таблицы
     *
     * @return string
     */
    public static function tableName()
    {
        return 'patrons';
    }

    /**
     * Правила валидации модели
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            /** Оставил комментарий для сравнения */
            // [['caliber', 'type', 'damage', 'probitie', 'damage_per_defence', 'speed', 'count', 'tochn', 'otdacha', 'fragmentation', 'iznos', 'blood_1', 'blood_2', 'rikochet', 'traccer'], 'string', 'max' => 255],
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_CALIBER, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_TYPE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_DAMAGE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_PROBITIE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_DAMAGE_PER_DEFENCE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_SPEED, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_COUNT, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_TOCHN, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_OTDACHA, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_FRAGMENTATION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_BLOOD_1, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_BLOOD_2, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_RIKOCHET, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_TRACCER, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_YB, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH]
        ];
    }

    /**
     * Переводы атрибутов
     *
     * @return array|string[]
     */
    public function attributeLabels(): array
    {
        return [
            static::ATTR_ID => 'ID',
            static::ATTR_CALIBER => 'Калибр',
            static::ATTR_TYPE => 'Вид патрона',
            static::ATTR_DAMAGE => 'Урон',
            static::ATTR_PROBITIE => 'Пробитие',
            static::ATTR_DAMAGE_PER_DEFENCE => 'Урон по броне',
            static::ATTR_SPEED => 'Скорость м/с',
            static::ATTR_COUNT => 'Снаряды кол-во',
            static::ATTR_TOCHN => 'Точность %',
            static::ATTR_OTDACHA => 'Отдача %',
            static::ATTR_FRAGMENTATION => 'Шанс фрагментации %',
            static::ATTR_BLOOD_1 => 'Тяжелое кровотечение %',
            static::ATTR_BLOOD_2 => 'Легкое кровотечение %',
            static::ATTR_RIKOCHET => 'Шанс рикошета',
            static::ATTR_TRACCER => 'Трассер',
            static::ATTR_YB => 'УБ'
        ];
    }

    /**
     * Возвращаем все объекты Patrons модели
     * Кеширование DB запроса на 1 час
     *
     * @return array
     */
    public static function takePatrons(): array
    {
        return static::find()->orderBy([static::ATTR_ID => SORT_ASC])->asArray()->cache(Yii::$app->params['cacheTime']['one_hour'])->all();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return PatronsQuery
     */
    public static function find(): PatronsQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new PatronsQuery(get_called_class());
    }
}