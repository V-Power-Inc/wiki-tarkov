<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doorkeys".
 *
 * @property integer $id
 * @property string $name
 * @property string $mapgroup
 * @property string $content
 * @property integer $active
 * @property string $date_create
 */
class Doorkeys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doorkeys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['content'], 'string'],
            [['active'], 'integer'],
            [['date_create'], 'safe'],
            [['name', 'mapgroup'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mapgroup' => 'Mapgroup',
            'content' => 'Content',
            'active' => 'Active',
            'date_create' => 'Date Create',
        ];
    }
}
