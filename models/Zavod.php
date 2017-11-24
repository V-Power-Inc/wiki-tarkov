<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zavod".
 *
 * @property integer $id
 * @property string $name
 * @property string $marker_group
 * @property double $coords_x
 * @property double $coords_y
 * @property string $content
 * @property integer $enabled
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
            [['name'], 'required'],
            [['coords_x', 'coords_y'], 'number'],
            [['content'], 'string'],
            [['enabled'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['marker_group'], 'string', 'max' => 55],
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
            'marker_group' => 'Marker Group',
            'coords_x' => 'Coords X',
            'coords_y' => 'Coords Y',
            'content' => 'Content',
            'enabled' => 'Enabled',
        ];
    }
}
