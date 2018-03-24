<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usercoockies".
 *
 * @property string $name
 * @property string $buttons
 * @property string $date_create
 */
class Usercoockies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usercoockies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buttons'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['date_create'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя кукиса',
            'buttons' => 'base64 закодированные ID нажатых кнопок',
            'date_create' => 'Дата создания кукиса',
        ];
    }
    
}
