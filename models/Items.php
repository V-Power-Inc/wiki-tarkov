<?php

namespace app\models;

use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "items".
 *
 * @property integer $id
 * @property string $title
 * @property string $preview
 * @property string $shortdesc
 * @property string $content
 * @property string $date_create
 * @property string $date_update
 * @property integer $active
 * @property string $url
 * @property string $description
 * @property string $keywords
 * @property integer $parentcat_id
 * @property integer $quest_item
 * @property string $trader_group
 * @property string $search_words
 * @property string $module_weapon
 * @property string $creator
 *
 * @property Category $parentcat
 * @property Category $maintcat
 */
class Items extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID            = 'id';
    const ATTR_TITLE         = 'title';
    const ATTR_PREVIEW       = 'preview';
    const ATTR_SHORTDESC     = 'shortdesc';
    const ATTR_CONTENT       = 'content';
    const ATTR_DATE_CREATE   = 'date_create';
    const ATTR_DATE_UPDATE   = 'date_update';
    const ATTR_ACTIVE        = 'active';
    const ATTR_URL           = 'url';
    const ATTR_DESCRIPTION   = 'description';
    const ATTR_KEYWORDS      = 'keywords';
    const ATTR_PARENTCAT_ID  = 'parentcat_id';
    const ATTR_QUEST_ITEM    = 'quest_item';
    const ATTR_TRADER_GROUP  = 'trader_group';
    const ATTR_SEARCH_WORDS  = 'search_words';
    const ATTR_MODULE_WEAPON = 'module_weapon';
    const ATTR_CREATOR       = 'creator';

    /** Константы связей таблицы */
    const RELATION_PARENTCAT = 'parentcat';
    const RELATION_MAINCAT   = 'maincat';

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    const FILE = 'file';

    /** @var string $questitem - Переменная квестового предмета */
    public $questitem;
    const QUESTITEM = 'questitem';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'shortdesc', 'url', 'description', 'creator'], 'required'],
            [['shortdesc', 'content', 'search_words', 'module_weapon'], 'string'],
            [['date_create', 'date_update', 'keywords', 'trader_group', 'quest_item'], 'safe'],
            [['file'], 'image'],
            [['active', 'parentcat_id'], 'integer'],
            [['title', 'preview', 'creator'], 'string', 'max' => 255],
            [['parentcat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['parentcat_id' => 'id']],
        ];
    }

    /** Преобразуем массив в строку для сохранения привязки предмета лута к нескольким торговцам **/
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->trader_group != null) {
                $this->trader_group = implode(", ", $this->trader_group);
            }
            return true;
        }
        return false;
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
            static::ATTR_TITLE => 'Название',
            static::ATTR_PREVIEW => 'Превьюшка предмета',
            static::ATTR_SHORTDESC => 'Короткое описание',
            static::ATTR_CONTENT => 'Содержимое',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_ACTIVE => 'Лут активен',
            static::ATTR_PARENTCAT_ID => 'Родительская категория',
            static::ATTR_URL => 'URL адрес',
            static::ATTR_DESCRIPTION => 'SEO описание',
            static::ATTR_KEYWORDS => 'SEO ключевые слова',
            static::ATTR_TRADER_GROUP => 'Относится к торговцам',
            static::ATTR_QUEST_ITEM => 'Квестовый предмет',
            static::ATTR_MODULE_WEAPON => 'Оружия связанные с модулем',
            static::ATTR_SEARCH_WORDS => 'Слова синонимы (livesearch)',
            static::ATTR_DATE_UPDATE => 'Дата последнего обновления',
            static::ATTR_CREATOR => 'Создан пользователем',
            static::FILE => 'Превьюшка предмета'
        ];
    }

    /*** Загрузка и сохранение превьюшек предмета - здесь не происходит ресайз картинки ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->save($catalog);
        }
    }

    /** Получаем список всех предметов из таблицы справочника лута **/
    public function getAllItems() {
        $Items = Items::find()->asArray()->all();
        return $Items;
    }

    /** Получаем все активные предметы из справочника лута в виде массива **/
    public function getActiveItems() {
        $activeLoot = Items::find()->where(['active' => 1])->asArray()->all();
        return $activeLoot;
    }

    /**
     * Ниже получаем родительскую категорию
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentcat()
    {
        return $this->hasOne(Category::class, ['id' => 'parentcat_id']);
    }

}
