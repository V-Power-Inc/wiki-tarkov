<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

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
 * @property string $customicon
 * @property string $exits_group
 * @property int $exit_anyway
 * @property string $date_update
 */
class Forest extends \yii\db\ActiveRecord
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

    public $file = null;
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
            [['enabled', 'exit_anyway'], 'integer'],
            [['name','exits_group'], 'string', 'max' => 100],
            [['marker_group'], 'string', 'max' => 55],
            [['customicon', 'date_update'], 'string', 'max' => 255],
            [['file'], 'image'],
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
            'customicon' => 'Иконка маркера',
            'exits_group' => 'Спавн был в зоне',
            'file' => 'Иконка маркера',
            'enabled' => 'Включен',
            'exit_anyway' => 'Общий выход',
        ];
    }

    /*** Загрузка и сохранение превьюшек маркера ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/foresticons/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->customicon = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }
}
