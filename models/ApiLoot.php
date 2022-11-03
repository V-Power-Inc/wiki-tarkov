<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\StringValidator;

/**
 * AR модель для работы с API, через которое на сайте актуализируется база лута
 *
 * @property int $id ID primary key
 * @property string $name Название предмета
 * @property string $json Json из которого разбираем данные
 * @property string $url URL адрес
 * @property string $date_create Дата создания записи о предмете
 * @property int $active Флаг активности записи
 * @property int $old Флаг возраста записи, если стоит 1, пора удалять
 */
class ApiLoot extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID = 'id';
    const ATTR_NAME = 'name';
    const ATTR_JSON = 'json';
    const ATTR_URL  = 'url';
    const ATTR_DATE_CREATE = 'date_create';
    const ATTR_ACTIVE = 'active';
    const ATTR_OLD = 'old';

    /** Константы bool значений */
    const TRUE = 1;
    const FALSE = 0;

    /**
     * Метод возвращающий имя таблицы
     *
     * @return string
     */
    public static function tableName()
    {
        return 'api_loot';
    }

    /**
     * Массив правил валидаций данной модели
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'json', 'url'], 'required'],
            [['json'], 'string'],
            [['date_create'], 'safe'],
            [['active', 'old'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],

            [static::ATTR_NAME, RequiredValidator::class],
            [static::ATTR_NAME, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_JSON, RequiredValidator::class],
            [static::ATTR_JSON, StringValidator::class],

            [static::ATTR_URL, RequiredValidator::class],
            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_ACTIVE, IntegerValidator::class],

            [static::ATTR_OLD, IntegerValidator::class]
        ];
    }

    /**
     * Массив переводов атрибутов данной модели
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_ID => 'ID',
            static::ATTR_NAME => 'Имя предмета',
            static::ATTR_JSON => 'Json данные',
            static::ATTR_URL => 'Url адрес',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_ACTIVE => 'Активность предмета',
            static::ATTR_ACTIVE => 'Старые записи'
        ];
    }
}