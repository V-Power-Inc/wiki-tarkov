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
    /** Константы атрибутов Active Record модели */
    const ATTR_ID           = 'id';
    const ATTR_NAME         = 'name';
    const ATTR_MARKER_GROUP = 'marker_group';
    const ATTR_COORDS_X     = 'coords_x';
    const ATTR_COORDS_Y     = 'coords_y';
    const ATTR_CONTENT      = 'content';
    const ATTR_ENABLED      = 'enabled';
    const ATTR_CUSTOMICON   = 'customicon';
    const ATTR_EXITS_GROUP  = 'exits_group';
    const ATTR_EXIT_ANYWAY  = 'exit_anyway';
    const ATTR_DATE_UPDATE  = 'date_update';

    /** Константы True/False для различных поисков */
    const TRUE  = 1;
    const FALSE = 0;

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
     * Переводы атрибутов
     *
     * @return array|string[]
     */
    public function attributeLabels(): array
    {
        return [
            static::ATTR_ID => 'ID',
            static::ATTR_NAME => 'Имя маркера',
            static::ATTR_MARKER_GROUP => 'Группа маркера',
            static::ATTR_COORDS_X => 'Координаты по оси X',
            static::ATTR_COORDS_Y => 'Координаты по оси Y',
            static::ATTR_CONTENT => 'Содержание',
            static::ATTR_CUSTOMICON => 'Иконка маркера',
            static::ATTR_EXITS_GROUP => 'Спавн был в зоне',
            static::ATTR_ENABLED => 'Включен',
            static::ATTR_EXIT_ANYWAY => 'Общий выход'
        ];
    }
}
