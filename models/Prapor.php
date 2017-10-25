<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prapor".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $date_create
 * @property string $date_edit
 */
class Prapor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prapor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_edit'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название квеста',
            'content' => 'Содержание квеста',
            'date_create' => 'Дата создания',
            'date_edit' => 'Дата редактирования (Старые записи идут выше)',
        ];
    }
}
