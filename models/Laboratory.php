<?php

namespace app\models;

/**
 * This is the model class for table "laboratory".
 *
 * @property int $id
 * @property string $name
 * @property string $marker_group
 * @property double $coords_x
 * @property double $coords_y
 * @property string $content
 * @property int $enabled
 * @property string $customicon
 * @property string $exits_group
 * @property int $exit_anyway
 * @property string $date_update
 */
class Laboratory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'laboratory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coords_x', 'coords_y'], 'number'],
            [['content'], 'string'],
            [['enabled', 'exit_anyway'], 'integer'],
            [['date_update'], 'safe'],
            [['name', 'marker_group', 'exits_group'], 'string', 'max' => 100],
            [['customicon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
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
            'customicon' => 'Customicon',
            'exits_group' => 'Exits Group',
            'exit_anyway' => 'Exit Anyway',
            'date_update' => 'Date Update',
        ];
    }
}
