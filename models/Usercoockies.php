<?php

namespace app\models;

/**
 * This is the model class for table "usercoockies".
 *
 * @property integer $id
 * @property string $name
 * @property string $buttons
 * @property string $date_create
 * @property string $date_edit
 */

/*** Разработка кукисов остановлена с 04.04.2018г. ***/
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
            [['date_create', 'date_edit'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Автоинкрементарный ID записей кукисов',
            'name' => 'Имя кукиса',
            'buttons' => 'Json массив кнопок',
            'date_create' => 'Дата создания кукиса',
            'date_edit' => 'Дата последнего изменения кукива',
        ];
    }
    
}
