<?php

namespace app\models;

use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\SafeValidator;
use app\models\queries\ApiSearchLogsQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
use Yii;

/**
 * Поисковая модель, которая хранит в БД логи поисковых запросов пользователей к API и иную полезную информацию
 *
 * @property int $id ID primary key
 * @property string $words Поисковый запрос, который пользователи отправляли на сервер
 * @property string $info Поле для дополнительной информации - на перспективу
 * @property string $date_create Дата создания записи лога
 * @property int $flag Флаг для проверки вернулись ли данные по запросу или нет
 */
class ApiSearchLogs extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID           = 'id';
    const ATTR_WORDS        = 'words';
    const ATTR_INFO         = 'info';
    const ATTR_DATE_CREATE  = 'date_create';
    const ATTR_FLAG         = 'flag';

    /** Константы для проверки Bool значений */
    const TRUE = 1;
    const FALSE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api_search_logs';
    }

    /**
     * Массив с правилами валидации текущей модели
     *
     * @return array
     */
    public function rules()
    {
        return [
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_INFO, StringValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_WORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_INFO, StringValidator::class],

            [static::ATTR_FLAG, IntegerValidator::class]
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
            static::ATTR_WORDS => 'Поисковый запрос',
            static::ATTR_INFO => 'Капча пользователя',
            static::ATTR_DATE_CREATE => 'Дата создания'
        ];
    }

    /**
     * Ищем капчу в таблице логов и возвраем если нашли или возвращаем null если не нашли
     *
     * @param string $captcha
     * @return ApiSearchLogs|null
     */
    public static function findCaptchaCode(string $captcha)
    {
        return static::findOne([static::ATTR_INFO => $captcha]);
    }

    /**
     * Метод возвращает объект запроса для последующего использования в JsondataService
     *
     * @param string $title - Поисковый запрос
     * @return Query
     */
    public static function getSearchWordsForSelectSearch(string $title): Query
    {
        /** Объект запроса к БД */
        $query = new Query;

        /** Выбираем нужные данные с кешируемым запросом */
        $query->select(static::ATTR_WORDS)
            ->from(static::tableName())
            ->where(static::ATTR_WORDS .' LIKE "%' . $title . '%"')
            ->andWhere([static::ATTR_FLAG => static::TRUE])
            ->groupBy(static::ATTR_WORDS)
            ->orderBy(static::ATTR_DATE_CREATE)
            ->cache(Yii::$app->params['cacheTime']['one_hour']);

        /** Возвращаем объект запроса к БД */
        return $query;
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return ApiSearchLogsQuery
     */
    public static function find(): ApiSearchLogsQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new ApiSearchLogsQuery(get_called_class());
    }
}