<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property integer $id
 * @property string $title
 * @property string $preview
 * @property string $category
 * @property string $shortdesc
 * @property string $content
 * @property string $date_create
 * @property integer $active
 * @property integer $parentcat_id
 *
 * @property ItemsToDoorkeys[] $itemsToDoorkeys
 * @property ItemsToLyjnic[] $itemsToLyjnics
 * @property ItemsToMechanik[] $itemsToMechaniks
 * @property ItemsToMirotvorec[] $itemsToMirotvorecs
 * @property ItemsToPrapor[] $itemsToPrapors
 * @property ItemsToTerapevt[] $itemsToTerapevts
 * @property Category $parentcat
 */
class Items extends \yii\db\ActiveRecord
{
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
            [['title', 'shortdesc'], 'required'],
            [['shortdesc', 'content'], 'string'],
            [['date_create'], 'safe'],
            [['active', 'parentcat_id'], 'integer'],
            [['title', 'preview', 'category'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'preview' => 'Preview',
            'category' => 'Category',
            'shortdesc' => 'Shortdesc',
            'content' => 'Content',
            'date_create' => 'Date Create',
            'active' => 'Active',
            'parentcat_id' => 'Parentcat ID',
        ];
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

    /*** Ниже получаем родительскую категорию ***/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentcat()
    {
        return $this->hasOne(Category::className(), ['id' => 'parentcat_id']);
    }
}
