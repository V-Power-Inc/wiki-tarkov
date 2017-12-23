<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forest".
 *
 * @property integer $id
 * @property string $name
 * @property string $marker_group
 * @property double $coords_x
 * @property double $coords_y
 * @property string $content
 * @property integer $enabled
 */
class Forest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forest';
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
            'name' => 'Имя маркера',
            'marker_group' => 'Группа маркера',
            'coords_x' => 'Координаты по оси X',
            'coords_y' => 'Координаты по оси Y',
            'content' => 'Содержание',
            'enabled' => 'Включен',
        ];
    }
}
