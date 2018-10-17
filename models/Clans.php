<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "clans".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $preview
 * @property string $link
 * @property string $date_create
 * @property int $moderated
 */
class Clans extends \yii\db\ActiveRecord
{
    
    public $file;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['link'], 'string'],
            [['date_create'], 'safe'],
            [['moderated'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 300],
            [['preview'], 'string', 'max' => 255],
            [['file'], 'image'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название клана',
            'description' => 'Краткое описание клана',
            'preview' => 'Превью клана',
            'file' => 'Превью клана',
            'link' => 'Ссылка на сообщество клана',
            'date_create' => 'Дата регистрации',
            'moderated' => 'Модерация пройдена',
        ];
    }

    /*** Загрузка и сохранение логотипов кланов ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/clans' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(100, 100))->save($catalog , ['quality' => 70]);
        }
    }
}
