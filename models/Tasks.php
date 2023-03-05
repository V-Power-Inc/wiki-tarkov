<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id ID primary key
 * @property string $quest Название квеста
 * @property string $trader_name Имя торговца, что выдает квест
 * @property string $trader_icon Иконка торговца
 * @property string $json Json из которого разбираем данные для заполнения квестов
 * @property string $date_create Дата создания записи о квесте
 * @property int $active Флаг активности записи
 * @property int $old Флаг возраста записи, если стоит 1, пора удалять
 */
class Tasks extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID           = 'id';
    const ATTR_QUEST        = 'quest';
    const ATTR_TRADER_NAME  = 'trader_name';
    const ATTR_TRADER_ICON  = 'trader_icon';
    const ATTR_JSON         = 'json';
    const ATTR_DATE_CREATE  = 'date_create';
    const ATTR_ACTIVE       = 'active';
    const ATTR_OLD          = 'old';

    /** Константы True/False для различных поисков */
    const TRUE  = 1;
    const FALSE = 0;

    /**
     * Метод возвращающий имя таблицы
     *
     * @return string
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * Массив правил валидаций данной модели
     *
     * @return array
     */
    public function rules()
    {
        return [
            [static::ATTR_QUEST, RequiredValidator::class],
            [static::ATTR_QUEST, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_TRADER_NAME, RequiredValidator::class],
            [static::ATTR_TRADER_NAME, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_TRADER_ICON, RequiredValidator::class],
            [static::ATTR_TRADER_ICON, StringValidator::class],

            [static::ATTR_JSON, RequiredValidator::class],
            [static::ATTR_JSON, StringValidator::class],

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
            'id' => 'ID',
            'quest' => 'Название квеста',
            'trader_name' => 'Имя торговца',
            'trader_icon' => 'Иконка торговца',
            'json' => 'Json с данными о квести',
            'date_create' => 'Дата создания',
            'active' => 'Активен',
            'old' => 'Запись устарела'
        ];
    }
}
