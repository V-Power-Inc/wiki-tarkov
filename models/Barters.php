<?php

namespace app\models;

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
class Barters extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID           = 'id';
    const ATTR_TITLE        = 'title';
    const ATTR_SITE_TITLE   = 'site_title';
    const ATTR_TRADER_GROUP = 'trader_group';
    const ATTR_CONTENT      = 'content';
    const ATTR_DATE_CREATE  = 'date_create';
    const ATTR_ENABLED      = 'enabled';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'trader_group', 'site_title'], 'required'],
            [['content'], 'string'],
            [['date_create'], 'safe'],
            [['enabled'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['site_title'], 'string', 'max' => 255],
            [['trader_group'], 'string', 'max' => 255],
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
}
