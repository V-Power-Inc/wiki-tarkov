<?php

namespace app\models;

use Yii;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
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
 * @property ItemsToDoorkeys[] $itemsToDoorkeys
 * @property ItemsToLyjnic[] $itemsToLyjnics
 * @property ItemsToMechanik[] $itemsToMechaniks
 * @property ItemsToMirotvorec[] $itemsToMirotvorecs
 * @property ItemsToPrapor[] $itemsToPrapors
 * @property ItemsToTerapevt[] $itemsToTerapevts
 * @property Category $parentcat
 * @property Category $maintcat
 */
class Items extends \yii\db\ActiveRecord
{

    public $file = null;
    public $questitem;

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
            [['parentcat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parentcat_id' => 'id']],
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
     * @inheritdoc
     */
    // todo: Продумать функицонал связывающий модуль и пушки, на которые он цепляется
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'preview' => 'Превьюшка предмета',
            'shortdesc' => 'Короткое описание',
            'content' => 'Содержимое',
            'date_create' => 'Дата создания',
            'active' => 'Лут активен',
            'parentcat_id' => 'Родительская категория',
            'file' => 'Превьюшка предмета',
            'url' => 'URL адрес',
            'maincat_id' => 'Корневая категория',
            'fullurl' => 'Полный URL адрес',
            'description' => 'SEO описание',
            'keywords' => 'SEO ключевые слова',
            'trader_group' => 'Относится к торговцам',
            'quest_item' => 'Квестовый предмет',
            'questitem' => '',
            'module_weapon' => 'Оружия связанные с модулем',
            'search_words' => 'Слова синонимы (livesearch)',
            'date_update' => 'Дата последнего обновления',
            'creator' => 'Создан пользователем'
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsToDoorkeys()
    {
        return $this->hasMany(ItemsToDoorkeys::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsToLyjnics()
    {
        return $this->hasMany(ItemsToLyjnic::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsToMechaniks()
    {
        return $this->hasMany(ItemsToMechanik::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsToMirotvorecs()
    {
        return $this->hasMany(ItemsToMirotvorec::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsToPrapors()
    {
        return $this->hasMany(ItemsToPrapor::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsToTerapevts()
    {
        return $this->hasMany(ItemsToTerapevt::className(), ['item_id' => 'id']);
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

    /*** Ниже получаем родительскую категорию ***/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentcat()
    {
        return $this->hasOne(Category::className(), ['id' => 'parentcat_id']);
    }

}
