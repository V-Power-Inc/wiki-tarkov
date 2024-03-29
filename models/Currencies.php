<?php

namespace app\models;

use app\models\queries\CurrenciesQuery;
use Yii;

use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\IntegerValidator;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "currencies".
 *
 * @property int $id
 * @property string $title
 * @property int $value
 * @property int $enabled
 */
class Currencies extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID      = 'id';
    public const ATTR_TITLE   = 'title';
    public const ATTR_VALUE   = 'value';
    public const ATTR_ENABLED = 'enabled';

    /** Константы True/False для различных поисков */
    public const TRUE  = 1;
    public const FALSE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currencies';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_VALUE, IntegerValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH]
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
            static::ATTR_TITLE => 'Название валюты',
            static::ATTR_VALUE => 'Эквивалент в копейках (Правильный формат хранения значений валют)',
            static::ATTR_ENABLED => 'Значение активно'
        ];
    }

    /**
     * Получаем курсы всех активных валют
     *
     * @return array|ActiveRecord[]
     */
    public static function takeActiveValutes(): array
    {
        return static::find()->where([static::ATTR_ENABLED => static::TRUE])->asArray()->all();
    }

    /**
     * Достаем курс доллара из таблицы
     *
     * @return ActiveRecord|null
     */
    public static function takeDollar()
    {
        return static::find()->where([static::ATTR_TITLE => 'Доллар'])->cache(Yii::$app->params['cacheTime']['one_hour'])->One();
    }

    /**
     * Достаем курс евро из таблицы
     *
     * @return ActiveRecord|null
     */
    public static function takeEuro()
    {
        return static::find()->where([static::ATTR_TITLE => 'Евро'])->cache(Yii::$app->params['cacheTime']['one_hour'])->One();
    }

    /**
     * Достаем курс биткоина из таблицы
     *
     * @return ActiveRecord|null
     */
    public static function takeBitkoin()
    {
        return static::find()->where([static::ATTR_TITLE => 'Биткоин'])->cache(Yii::$app->params['cacheTime']['one_hour'])->One();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return CurrenciesQuery
     */
    public static function find(): CurrenciesQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new CurrenciesQuery(get_called_class());
    }
}