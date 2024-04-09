<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\StringValidator;
use app\models\queries\BartersQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "barters".
 *
 * @property int $id
 * @property string $title
 * @property string $site_title
 * @property string $trader_group
 * @property string $content
 * @property string $date_create
 * @property int $enabled
 */
class Barters extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID           = 'id';
    public const ATTR_TITLE        = 'title';
    public const ATTR_SITE_TITLE   = 'site_title';
    public const ATTR_TRADER_GROUP = 'trader_group';
    public const ATTR_CONTENT      = 'content';
    public const ATTR_DATE_CREATE  = 'date_create';
    public const ATTR_ENABLED      = 'enabled';

    /** Константы True/False для различных поисков */
    public const TRUE  = 1;
    public const FALSE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barters';
    }

    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_TITLE, RequiredValidator::class],
            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_TRADER_GROUP, RequiredValidator::class],
            [static::ATTR_TRADER_GROUP, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_SITE_TITLE, RequiredValidator::class],
            [static::ATTR_SITE_TITLE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class]
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
            static::ATTR_TITLE => 'Название',
            static::ATTR_SITE_TITLE => 'Название на сайте',
            static::ATTR_TRADER_GROUP => 'Относится к торговцу',
            static::ATTR_CONTENT => 'Содержимое',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_ENABLED => 'Активен'
        ];
    }

    /**
     * Получаем бартеры для торговца по названию торговца title
     *
     * @param string $title
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function takeBartersByTitle(string $title): array
    {
        return static::find()
            ->where(['like', static::ATTR_TITLE, $title])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->orderby([static::ATTR_ID => SORT_ASC])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->asArray()
            ->all();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return BartersQuery
     */
    public static function find(): BartersQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new BartersQuery(get_called_class());
    }

    /**
     * Получаем ID записи превью бартера по названию модели
     *
     * @param string $title
     * @return false|int|string|null
     */
    public static function getBarterIdByTitle(string $title)
    {
        return static::find()
            ->select(static::ATTR_ID)
            ->where([static::ATTR_TITLE => $title])
            ->scalar();
    }
}