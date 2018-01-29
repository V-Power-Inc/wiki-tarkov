<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;

/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $preview
 * @property string $content
 * @property string $date_create
 * @property integer $enabled
 * @property string $description
 * @property string $keywords
 * @property string $shortdesc
 */
class Articles extends \yii\db\ActiveRecord
{

    /** Переменная файла превьюшки полезной статьи **/
    public $file=null;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['content', 'shortdesc'], 'string'],
            [['date_create'], 'safe'],
            [['enabled'], 'integer'],
            [['title', 'description', 'keywords'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 100],
            [['preview'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок статьи',
            'url' => 'Url адрес статьи',
            'preview' => 'Превью картинка статьи',
            'content' => 'Содержание',
            'date_create' => 'Дата создания',
            'enabled' => 'Статья активна',
            'description' => 'SEO Описание',
            'keywords' => 'SEO ключевые слова',
            'shortdesc' => 'Короткое описание',
            'file' => 'Превьюшка полезной статьи',
        ];
    }

    /*** Загрузка и сохранение превьюшек квеста ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }
}
