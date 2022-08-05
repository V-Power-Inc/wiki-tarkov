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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'site_title' => 'Название на сайте',
            'trader_group' => 'Относится к торговцу',
            'content' => 'Содержимое',
            'date_create' => 'Дата создания',
            'enabled' => 'Активен',
        ];
    }
}
