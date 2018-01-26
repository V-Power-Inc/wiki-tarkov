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

    /** Получаем корневые категории которые активны */
    public function getMainCategories() {
        $categories = Category::find()->where(['enabled' => '1'])->andWhere(['parent_category' => null])->asArray()->all();
        return $categories;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['parentcat_id' => 'id']);
    }
}
