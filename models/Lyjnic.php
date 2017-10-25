<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lyjnic".
 *
 * @property integer $id
 * @property integer $tab_number
 * @property string $title
 * @property string $content
 * @property string $date_create
 * @property string $date_edit
 */
class Lyjnic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lyjnic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tab_number'], 'integer'],
            [['content'], 'string'],
            [['date_create', 'date_edit'], 'safe'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tab_number' => 'Сортировка',
            'title' => 'Название квеста',
            'content' => 'Содержание квеста',
            'date_create' => 'Дата создания',
            'date_edit' => 'Дата последнего редактирования',
        ];
    }
}
