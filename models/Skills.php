<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;

/**
 * This is the model class for table "skills".
 *
 * @property integer $id
 * @property string $title
 * @property integer $category
 * @property string $url
 * @property integer $enabled
 * @property string $description
 * @property string $keywords
 * @property string $preview
 * @property string $content
 * @property string $short_desc
 *
 * @property CatSkills $category0
 */
class Skills extends \yii\db\ActiveRecord
{
    
    public $file;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'enabled'], 'integer'],
            [['content', 'short_desc'], 'string'],
            [['url'], 'unique', 'message' => 'Значение url не является уникальным'],
            [['title', 'url', 'description', 'keywords', 'preview'], 'string', 'max' => 255],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Catskills::className(), 'targetAttribute' => ['category' => 'id']],
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
            'title' => 'Заголовок умения',
            'category' => 'Родительская категория',
            'url' => 'URL адрес умения',
            'enabled' => 'Включен',
            'description' => 'SEO описание',
            'keywords' => 'SEO ключевые слова',
            'preview' => 'Превьюшка умения',
            'file' => 'Превьюшка умения',
            'content' => 'Содержание',
            'short_desc' => 'Краткое описание',
        ];
    }

    /*** Загрузка и сохранение превьюшек умений ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(68, 69))->save($catalog , ['quality' => 90]);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Catskills::className(), ['id' => 'category']);
    }
}
