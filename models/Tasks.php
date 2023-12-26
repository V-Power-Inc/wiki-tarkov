<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;
use app\models\queries\TasksQuery;
use yii\db\ActiveRecord;

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
 * @property string $url Url адрес до квестов конкретного торговца
 */
class Tasks extends ActiveRecord
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
    const ATTR_URL          = 'url';

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
            [static::ATTR_ID, IntegerValidator::class],

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

            [static::ATTR_OLD, IntegerValidator::class],

            [static::ATTR_URL, StringValidator::class]
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
            static::ATTR_QUEST => 'Название квеста',
            static::ATTR_TRADER_NAME => 'Имя торговца',
            static::ATTR_TRADER_ICON => 'Иконка торговца',
            static::ATTR_JSON => 'Json с данными о квести',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_ACTIVE => 'Активен',
            static::ATTR_OLD => 'Запись устарела',
            static::ATTR_URL => 'Url до квестов торговца'
        ];
    }

    /**
     * Метод проверяет есть ли записи с квестами конкретного торговца или нет - возвращает bool результат
     *
     * @param string $url - Url адрес до квестов торговца
     * @return bool
     */
    public static function isExists(string $url): bool
    {
        return Tasks::findAll([static::ATTR_URL => $url]) ? true : false;
    }

    /**
     * Метод возвращает все AR объекты квестов для конкретного торговца
     *
     * @param string $url - URL адрес до квестов босса
     * @return mixed
     */
    public static function getTasksData(string $url): array
    {
        return Tasks::findAll([Tasks::ATTR_URL => $url]) ?? false;
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return TasksQuery
     */
    public static function find(): TasksQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new TasksQuery(get_called_class());
    }
}