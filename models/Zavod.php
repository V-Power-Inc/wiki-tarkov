<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;

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
 * @property string $customicon
 * @property string $exits_group
 * @property int $exit_anyway
 */
class Zavod extends \yii\db\ActiveRecord
{
    public $file = null;
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
            [['enabled', 'exit_anyway'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['marker_group'], 'string', 'max' => 55],
            [['customicon'], 'string', 'max' => 255],
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
            'enabled' => 'Включен',
            'customicon' => 'Иконка маркера',
            'file' => 'Иконка маркера',
        ];
    }

    /*** Загрузка и сохранение превьюшек маркера ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/zavodicons/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->customicon = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }
}
