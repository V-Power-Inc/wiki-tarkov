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
 * @property integer $active
 * @property string $url
 * @property integer $parentcat_id
 * @property integer $maincat_id
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
            [['title', 'shortdesc', 'maincat_id', 'url'], 'required'],
            [['shortdesc', 'content'], 'string'],
            [['date_create'], 'safe'],
            [['file'], 'image'],
            [['active', 'parentcat_id'], 'integer'],
            [['title', 'preview'], 'string', 'max' => 255],
            [['parentcat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parentcat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
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

    /*** Ниже получаем родительскую категорию ***/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentcat()
    {
        return $this->hasOne(Category::className(), ['id' => 'parentcat_id']);
    }

    public function getMaincat()
    {
        return $this->hasOne(Category::className(), ['id' => 'maincat_id']);
    }
    
    
    
}
