<?php

namespace app\models;

use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\SafeValidator;
use yii\db\ActiveRecord;

/**
 * AR модель для работы с записями боссов, полученными через API
 *
 * @property int $id ID primary key
 * @property string $map Название карты спавна
 * @property string $bosses Поле в котором хранится Json с данными о боссах
 * @property string $date_create Дата создания записи о боссах
 * @property int $active Флаг активности записи
 * @property int $old Флаг возраста записи, если стоит 1, пора удалять
 * @property string $url Url адрес до карты с боссами
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
    const ATTR_URL = 'url';

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

            [static::ATTR_MAP, StringValidator::class, StringValidator::ATTR_MAX => 100],

            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH]
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
            static::ATTR_MAP => 'Карта',
            static::ATTR_BOSSES => 'Боссы',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_ACTIVE => 'Активность',
            static::ATTR_OLD => 'Устаревшая информация',
            static::ATTR_URL => 'Url адрес до локации с боссами'
        ];
    }

    /**
     * Метод возвращаем string - полученый из атрибута bosses текущего объекта
     *
     * @param string $map_url - url адрес карты
     * @return string
     */
    public static function getBossData(string $map_url): string
    {
        return Bosses::find()->select(static::ATTR_BOSSES)->where([Bosses::ATTR_URL => $map_url])->scalar();
    }

    /**
     * Метод возвращает массив имен карт из таблицы Bosses
     *
     * @return Bosses[]
     */
    public static function getMapData()
    {
        return Bosses::find()->select([Bosses::ATTR_MAP, Bosses::ATTR_URL])->all();
    }

    /**
     * Метод возвращает русское название карты по url адресу (AR Bosses)
     *
     * @param string $url - Url адрес до локации с боссами
     * @return ActiveRecord
     */
    public static function findMapTitleByUrl(string $url): ActiveRecord
    {
        return Bosses::find()->select(Bosses::ATTR_MAP)->where([Bosses::ATTR_URL => $url])->one();
    }

    /**
     * По параметру URL определяем существует ли запись в БД
     *
     * @param string $url - Строка с URL адресом
     * @return bool
     */
    public static function isExists(string $url): bool
    {
        return Bosses::findOne([static::ATTR_URL => $url]) ? true : false;
    }
}
