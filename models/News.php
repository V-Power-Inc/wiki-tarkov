<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "news".
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
class News extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID          = 'id';
    const ATTR_TITLE       = 'title';
    const ATTR_URL         = 'url';
    const ATTR_PREVIEW     = 'preview';
    const ATTR_CONTENT     = 'content';
    const ATTR_DATE_CREATE = 'date_create';
    const ATTR_ENABLED     = 'enabled';
    const ATTR_DESCRIPTION = 'description';
    const ATTR_KEYWORDS    = 'keywords';
    const ATTR_SHORTDESC   = 'shortdesc';

    public $file=null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'keywords', 'shortdesc'], 'required'],
            [['content'], 'string'],
            [['date_create'], 'safe'],
            [['enabled'], 'integer'],
            [['title'], 'string', 'max' => 150],
            [['url'], 'string', 'max' => 255],
            [['preview'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название новости',
            'url' => 'Url-адрес',
            'preview' => 'Превьюшка новости',
            'content' => 'Содержимое',
            'date_create' => 'Дата создания',
            'enabled' => 'Новость активна',
            'file' => 'Превьюшка новости',
            'description' => 'Метатег description',
            'keywords' => 'Метатег keywords',
            'shortdesc' => 'Краткое описание',
        ];
    }

    /*** Загрузка и сохранение превьюшек квеста ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/news/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(200, 113))->save($catalog , ['quality' => 90]);
        }
    }
}
