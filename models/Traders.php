<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;

/**
 * This is the model class for table "traders".
 *
 * @property integer $id
 * @property string $title
 * @property string $preview
 * @property string $content
 * @property string $urltoquets
 * @property string $button_quests
 * @property string $button_detail
 * @property string $bg_style
 * @property string $fullcontent
 * @property string $description
 * @property string $keywords
 * @property string $url
 * @property integer $sortir
 * @property integer $enabled
 */
class Traders extends \yii\db\ActiveRecord
{

    public $file=null;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'traders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'sortir'], 'required'],
            [['bg_style', 'content', 'fullcontent'], 'string'],
            [['enabled', 'sortir'], 'integer'],
            [['file'], 'image'],
            [['title', 'preview', 'urltoquets', 'button_quests', 'button_detail', 'description', 'keywords', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Имя торговца',
            'preview' => 'Превьюшка торговца',
            'content' => 'Содержимое',
            'urltoquets' => 'Ссылка на квесты',
            'button_quests' => 'Надпись на ссылке квестов',
            'button_detail' => 'Надпись на ссылке детальной страницы',
            'bg_style' => 'Фон блока',
            'enabled' => 'Активен',
            'file' => 'Файл превьюшки',
            'sortir' => 'Сортировка',
            'fullcontent' => 'Детальное содержимое',
            'description' => 'SEO описание',
            'keywords' => 'SEO ключевые слова',
            'url' => 'Адрес детального раздела торговца',
        ];
    }

    /*** Загрузка и сохранение превьюшек торговца ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(130, 130))->save($catalog , ['quality' => 90]);
        }
    }
}