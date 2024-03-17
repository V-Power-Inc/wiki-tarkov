<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\StringValidator;
use app\models\queries\ApiLootQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * AR модель для работы с API, через которое на сайте актуализируется база лута
 *
 * @property int $id ID primary key
 * @property string $name Название предмета
 * @property string $json Json из которого разбираем данные
 * @property string $url URL адрес
 * @property string $date_create Дата создания записи о предмете
 * @property int $active Флаг активности записи
 */
class ApiLoot extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID = 'id';
    public const ATTR_NAME = 'name';
    public const ATTR_JSON = 'json';
    public const ATTR_URL  = 'url';
    public const ATTR_DATE_CREATE = 'date_create';
    public const ATTR_ACTIVE = 'active';

    /** Константы bool значений */
    public const TRUE = 1;
    public const FALSE = 0;

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
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_NAME, RequiredValidator::class],
            [static::ATTR_NAME, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_JSON, RequiredValidator::class],
            [static::ATTR_JSON, StringValidator::class],

            [static::ATTR_URL, RequiredValidator::class],
            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_ACTIVE, IntegerValidator::class]
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
            static::ATTR_ACTIVE => 'Активность предмета'
        ];
    }

    /**
     * Метод ищет по названию предметы в таблице ApiLoot - возвращает AR объект ApiLoot или null если не нашел
     * Селектим Json и Url
     *
     * @param string $name - имя предмета
     * @return ApiLoot[]
     */
    public static function findItemsByName(string $name)
    {
        return ApiLoot::find()
            ->select([ApiLoot::ATTR_JSON, ApiLoot::ATTR_URL])
            ->where(['like', ApiLoot::ATTR_NAME, $name])
            ->all();
    }

    /**
     * Метод возвращает массив объектов ApiLoot - все актульные записи справочника лута
     * Селектим только строку с Json'ом и URL
     *
     * Используется с пагинацией
     *
     * @return ActiveQuery
     */
    public static function findActualItems()
    {
        return ApiLoot::find()
            ->select([ApiLoot::ATTR_JSON, ApiLoot::ATTR_URL])
            ->where([ApiLoot::ATTR_ACTIVE => ApiLoot::TRUE])
            ->orderBy([ApiLoot::ATTR_DATE_CREATE => SORT_DESC]);
    }

    /**
     * Метод ищет запись по Url адресу и возвращает AR объект ApiLoot или null
     * если не был найден объект
     *
     * @param string $url
     * @return ApiLoot|null
     */
    public static function findItemByUrl(string $url)
    {
        return ApiLoot::findOne([ApiLoot::ATTR_URL => $url]);
    }

    /**
     * Метод обновляет существующий предмет из API новыми данными
     *
     * @param array $api_data - массив с данными о предмете из API
     * @return bool
     */
    public function updateData(array $api_data): bool
    {
        /** Сетапим данные AR модели */
        $this->json = Json::encode($api_data['data']['item']);
        $this->name = $api_data['data']['item']['name'];
        $this->date_create = date('Y-m-d H:i:s');

        /** Сохраняем обновленный предмет */
        return $this->save();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return ApiLootQuery
     */
    public static function find(): ApiLootQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new ApiLootQuery(get_called_class());
    }
}