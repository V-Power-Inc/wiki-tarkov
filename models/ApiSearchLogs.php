<?php

namespace app\models;

use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\SafeValidator;
use app\models\queries\ApiSearchLogsQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\db\Expression;
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
final class ApiSearchLogs extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID           = 'id';
    public const ATTR_WORDS        = 'words';
    public const ATTR_INFO         = 'info';
    public const ATTR_DATE_CREATE  = 'date_create';
    public const ATTR_FLAG         = 'flag';

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
            [self::ATTR_ID, IntegerValidator::class],

            [self::ATTR_INFO, StringValidator::class],

            [self::ATTR_DATE_CREATE, SafeValidator::class],

            [self::ATTR_WORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [self::ATTR_INFO, StringValidator::class],

            [self::ATTR_FLAG, IntegerValidator::class]
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
            self::ATTR_ID => 'ID',
            self::ATTR_WORDS => 'Поисковый запрос',
            self::ATTR_INFO => 'Капча пользователя',
            self::ATTR_DATE_CREATE => 'Дата создания'
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
        return self::findOne([self::ATTR_INFO => $captcha]);
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
        $query->select(self::ATTR_WORDS)
            ->from(self::tableName())
            ->where(new Expression(
                '`'.self::ATTR_WORDS .'` LIKE "%' . $title . '%"',
                [':query' => $query]
            ))
            ->andWhere([self::ATTR_FLAG => self::TRUE])
            ->groupBy(self::ATTR_WORDS)
            ->orderBy(self::ATTR_DATE_CREATE)
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