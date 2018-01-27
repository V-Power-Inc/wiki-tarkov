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
 *
 * @property Items[] $items
 */
class Category extends \yii\db\ActiveRecord
{
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
            [['title', 'url', 'description'], 'required'],
            [['parent_category', 'enabled'], 'integer'],
            [['content'], 'string'],
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
            'enabled' => 'Включен',
        ];
    }

    /** Получаем все категории которые активны - indexBy заменяет ключ массива на ключ автоинкрементарного id из базы */
    public function getMainCategories() {
        $categories = Category::find()->where(['enabled' => '1'])->indexBy('id')->asArray()->all();
        return $categories;
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
        return $this->hasMany(Items::className(), ['parentcat_id' => 'id']);
    }
}
