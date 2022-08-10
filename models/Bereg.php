<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "bereg".
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
 * @property integer $exit_anyway
 * @property string $date_update
 */
class Bereg extends \yii\db\ActiveRecord
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

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    const FILE = 'file';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bereg';
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
            [['name', 'exits_group'], 'string', 'max' => 100],
            [['marker_group'], 'string', 'max' => 50],
            [['customicon', 'date_update'], 'string', 'max' => 255],
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
            static::ATTR_EXIT_ANYWAY => 'Общий выход',
            static::FILE => 'Иконка маркера'
        ];
    }

    /*** Загрузка и сохранение превьюшек маркера ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/beregicons/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->customicon = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }
}
