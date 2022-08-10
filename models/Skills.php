<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
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
    /** Константы атрибутов Active Record модели */
    const ATTR_ID            = 'id';
    const ATTR_TITLE         = 'title';
    const ATTR_CATEGORY      = 'category';
    const ATTR_URL           = 'url';
    const ATTR_ENABLED       = 'enabled';
    const ATTR_DESCRIPTION   = 'description';
    const ATTR_KEYWORDS      = 'keywords';
    const ATTR_PREVIEW       = 'preview';
    const ATTR_CONTENT       = 'content';
    const ATTR_SHORT_DESC    = 'short_desc';

    /** Константы связей таблицы */
    const RELATION_CATEGORY0 = 'category0';

    /** @var string $file - Переменная файла превьюшки null */
    public $file;
    const FILE = 'file';
    
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
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Catskills::class, 'targetAttribute' => ['category' => 'id']],
            [['file'], 'image'],
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
            static::ATTR_TITLE => 'Заголовок умения',
            static::ATTR_CATEGORY => 'Родительская категория',
            static::ATTR_URL => 'URL адрес умения',
            static::ATTR_ENABLED => 'Включен',
            static::ATTR_DESCRIPTION => 'SEO описание',
            static::ATTR_KEYWORDS => 'SEO ключевые слова',
            static::ATTR_PREVIEW => 'Превьюшка умения',
            static::ATTR_CONTENT => 'Содержание',
            static::ATTR_SHORT_DESC => 'Краткое описание',
            static::FILE => 'Превьюшка умения'
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
        return $this->hasOne(Catskills::class, ['id' => 'category']);
    }

    /** Получаем список всех предметов из таблицы справочника лута **/
    public function getAllItems() {
        $Items = Skills::find()->asArray()->all();
        return $Items;
    }
}
