<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mapstatic_content".
 *
 * @property integer $id
 * @property string $content
 * @property string $markername
 */
class Mapstaticcontent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mapstatic_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['content'], 'string'],
            [['markername'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Контент',
            'markername' => 'Группа маркеров',
        ];
    }
}
