<?php

namespace app\models;


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
            [['value', 'enabled'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
}
