<?php

namespace app\models;

use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\SafeValidator;

/**
 * This is the model class for table "bosses".
 *
 * @property int $id ID primary key
 * @property string $map Название карты спавна
 * @property string $bosses Поле в котором хранится Json с данными о боссах
 * @property string $date_create Дата создания записи о боссах
 * @property int $active Флаг активности записи
 * @property int $old Флаг возраста записи, если стоит 1, пора удалять
 */
class Bosses extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID = 'id';
    const ATTR_MAP = 'map';
    const ATTR_BOSSES = 'bosses';
    const ATTR_DATE_CREATE = 'date_create';
    const ATTR_ACTIVE = 'active';
    const ATTR_OLD = 'old';

    /** Константы bool значений */
    const TRUE = 1;
    const FALSE = 0;

    /**
     * Метод возвращающий имя текущей таблицы
     *
     * @return string
     */
    public static function tableName()
    {
        return 'bosses';
    }

    /**
     * Массив с правилами валидации текущей модели
     *
     * @return array
     */
    public function rules()
    {
        return [
            [static::ATTR_BOSSES, StringValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_ACTIVE, IntegerValidator::class],

            [static::ATTR_OLD, IntegerValidator::class],

            [static::ATTR_MAP, StringValidator::class, StringValidator::ATTR_MAX => 100]
        ];
    }

    /**
     * Переводы атрибутов
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_ID => 'ID',
            static::ATTR_MAP => 'Map',
            static::ATTR_BOSSES => 'Bosses',
            static::ATTR_DATE_CREATE => 'Date Create',
            static::ATTR_ACTIVE => 'Active',
            static::ATTR_OLD => 'Old'
        ];
    }
}
