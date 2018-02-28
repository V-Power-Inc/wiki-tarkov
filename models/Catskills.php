<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;

/**
 * This is the model class for table "cat_skills".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $sortir
 * @property string $url
 * @property string $description
 * @property string $keywords
 * @property integer $enabled
 * @property string $preview
 * @property string $bg_style
 *
 * @property Skills[] $skills
 */
class Catskills extends \yii\db\ActiveRecord
{

    public $file;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'bg_style'], 'string'],
            [['url'], 'unique', 'message' => 'Значение url не является уникальным'],
            [['sortir', 'enabled'], 'integer'],
            [['title', 'url', 'description', 'keywords', 'preview'], 'string', 'max' => 255],
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
            'title' => 'Название категории',
            'content' => 'Содержимое категории',
            'sortir' => 'Сортировка категории',
            'url' => 'Url категории',
            'description' => 'SEO описание категории',
            'keywords' => 'SEO ключевые слова',
            'enabled' => 'Категория активна',
            'preview' => 'Превьюшка категории',
            'file' => 'Превьюшка категории',
            'bg_style' => 'Цвет фона',
        ];
    }

    /*** Загрузка и сохранение превьюшек умений ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(130, 130))->save($catalog , ['quality' => 90]);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skills::className(), ['category' => 'id']);
    }
}
