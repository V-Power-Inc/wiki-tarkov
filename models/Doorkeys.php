<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;

/**
 * This is the model class for table "doorkeys".
 *
 * @property integer $id
 * @property string $name
 * @property string $mapgroup
 * @property string $content
 * @property integer $active
 * @property string $date_create
 * @property string $preview
 * @property string $shortcontent
 * @property string $url
 * @property string $description
 * @property string $keywords
 */
class Doorkeys extends \yii\db\ActiveRecord
{
    
/** Переменная файла превьюшки ключа **/
    public $file=null;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doorkeys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'keywords'], 'required'],
            [['content','shortcontent', 'url'], 'string'],
            [['active'], 'integer'],
            [['date_create', 'mapgroup'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Название ключа',
            'mapgroup' => 'Используется на картах',
            'content' => 'Содержание',
            'shortcontent' => 'Краткое описание',
            'active' => 'Включен',
            'date_create' => 'Дата создания',
            'file' => 'Превьюшка ключа',
            'preview' => 'Превьюшка ключа',
            'url' => 'Url адрес',
            'description' => 'Метатег description',
            'keywords' => 'Метатег keywords',
        ];
    }

    /** Преобразуем массив в строку для сохранения привязки ключей к нескольким локациям **/
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->mapgroup != null) {
                $this->mapgroup = implode(", ", $this->mapgroup);
            }
            return true;
        }
        return false;
    }

    /*** Загрузка и сохранение превьюшек квеста ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/doorkeys/' . $fileImg->baseName . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(64, 64))->save($catalog , ['quality' => 90]);
        }
    }
}
