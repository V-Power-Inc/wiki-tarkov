<?php

namespace app\models;

use Yii;

use app\common\validators\StringValidator;
use app\common\validators\IntegerValidator;
/**
 * This is the model class for table "currencies".
 *
 * @property int $id
 * @property string $title
 * @property int $value
 * @property int $enabled
 */
class Currencies extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID      = 'id';
    const ATTR_TITLE   = 'title';
    const ATTR_VALUE   = 'value';
    const ATTR_ENABLED = 'enabled';

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
    public function rules()
    {
        return [
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
     * Достаем курс доллара из таблицы
     *
     * @return array
     */
    public static function takeDollar(): array
    {
        return static::find()->where([static::ATTR_TITLE => 'Доллар'])->cache(Yii::$app->params['cacheTime']['one_hour'])->One();
    }

    /**
     * Достаем курс евро из таблицы
     *
     * @return array
     */
    public static function takeEuro(): array
    {
        return static::find()->where([static::ATTR_TITLE => 'Евро'])->cache(Yii::$app->params['cacheTime']['one_hour'])->One();
    }

    /**
     * Достаем курс биткоина из таблицы
     *
     * @return array
     */
    public static function takeBitkoin(): array
    {
        return static::find()->where([static::ATTR_TITLE => 'Биткоин'])->cache(Yii::$app->params['cacheTime']['one_hour'])->One();
    }

}
