<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_category
 * @property string $url
 * @property string $content
 * @property string $description
 * @property string $keywords
 * @property integer $enabled
 * @property integer $sortir
 *
 * @property Items[] $items
 */
class Category extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID              = 'id';
    const ATTR_TITLE           = 'title';
    const ATTR_PARENT_CATEGORY = 'parent_category';
    const ATTR_URL             = 'url';
    const ATTR_CONTENT         = 'content';
    const ATTR_DESCRIPTION     = 'description';
    const ATTR_KEYWORDS        = 'keywords';
    const ATTR_ENABLED         = 'enabled';
    const ATTR_SORTIR          = 'sortir';

    /** Константы связей таблицы */
    const RELATION_ITEMS       = 'items';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'sortir', 'url'], 'required'],
            [['parent_category', 'enabled', 'sortir'], 'integer'],
            [['content'], 'string'],
            [['url'], 'unique', 'message' => 'Значение url не является уникальным'],
            [['title', 'url', 'description', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Имя категории',
            'parent_category' => 'Родительская категория',
            'url' => 'Url адрес категории',
            'content' => 'Содержимое',
            'description' => 'SEO описание',
            'keywords' => 'SEO ключевые слова',
            'sortir' => 'Сортировка',
            'enabled' => 'Включен',
        ];
    }

    /** Получаем все категории которые активны - indexBy заменяет ключ массива на ключ автоинкрементарного id из базы */
    public function getMainCategories() {
        $categories = Category::find()->where(['enabled' => '1'])->indexBy('id')->asArray()->all();
        return $categories;
    }

    /** Получаем массив всех категорий, включенных и выключенных */
    public function getAllCategories() {
        $Categories = Category::find()->andWhere('parent_category' !== null)->indexBy('id')->asArray()->all();
        return $Categories;
    }

    /** Получаем массив всех дочерних категорий, включенных и выключенных */
    public function getChildCategories() {
        $Childcategories = Category::find()->andWhere('parent_category' !== null)->indexBy('id')->asArray()->all();
        return $Childcategories;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::class, ['parentcat_id' => 'id']);
    }

    /*** Связь таблицы сама на себя - получаем родительскую категорию ***/
    public function getParentcat()
    {
        return $this->hasOne(Category::class, ['id' => 'parent_category']);
    }
}
