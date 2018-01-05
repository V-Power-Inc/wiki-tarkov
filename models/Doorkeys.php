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
 * @property string $preview
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
            [['date_create', 'mapgroup'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название ключа',
            'mapgroup' => 'Используется на картах',
            'content' => 'Содержание',
            'active' => 'Включен',
            'date_create' => 'Дата создания',
            'preview' => 'Превьюшка ключа',
        ];
    }

    // Преобразуем массив в строку
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->mapgroup != null) {
                $this->mapgroup = implode(", ", $this->mapgroup);
            }
            return true;
        }
        return false;
    }
}
