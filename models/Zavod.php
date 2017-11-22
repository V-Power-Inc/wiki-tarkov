<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zavod".
 *
 * @property integer $id
 * @property string $coords_voen
 * @property string $voen_text
 * @property integer $active
 * @property string $date_create
 */
class Zavod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zavod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['voen_text'], 'string'],
            [['active'], 'integer'],
            [['date_create'], 'safe'],
            [['coords_voen'], 'string', 'max' => 70],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coords_voen' => 'Coords Voen',
            'voen_text' => 'Voen Text',
            'active' => 'Active',
            'date_create' => 'Date Create',
        ];
    }
}
