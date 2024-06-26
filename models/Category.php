<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\UniqueValidator;
use app\models\queries\CategoryQuery;
use yii\db\ActiveRecord;
use Yii;

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
class Category extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID              = 'id';
    public const ATTR_TITLE           = 'title';
    public const ATTR_PARENT_CATEGORY = 'parent_category';
    public const ATTR_URL             = 'url';
    public const ATTR_CONTENT         = 'content';
    public const ATTR_DESCRIPTION     = 'description';
    public const ATTR_KEYWORDS        = 'keywords';
    public const ATTR_ENABLED         = 'enabled';
    public const ATTR_SORTIR          = 'sortir';

    /** Константы связей таблицы */
    public const RELATION_ITEMS       = 'items';

    /** @var string - Константа, связь до родительской категории */
    public const RELATION_PARENTCAT   = 'parentcat';

    /** Константы bool значений */
    public const TRUE = 1;
    public const FALSE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_TITLE, RequiredValidator::class],
            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DESCRIPTION, RequiredValidator::class],
            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_SORTIR, RequiredValidator::class],
            [static::ATTR_SORTIR, IntegerValidator::class],

            [static::ATTR_URL, RequiredValidator::class],
            [static::ATTR_URL, UniqueValidator::class, UniqueValidator::ATTR_MESSAGE => 'Значение url не является уникальным'],
            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_PARENT_CATEGORY, IntegerValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_KEYWORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH]
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
            static::ATTR_TITLE => 'Имя категории',
            static::ATTR_PARENT_CATEGORY => 'Родительская категория',
            static::ATTR_URL => 'Url адрес категории',
            static::ATTR_CONTENT => 'Содержимое',
            static::ATTR_DESCRIPTION => 'SEO описание',
            static::ATTR_KEYWORDS => 'SEO ключевые слова',
            static::ATTR_SORTIR => 'Сортировка',
            static::ATTR_ENABLED => 'Включен'
        ];
    }

    /**
     * Получаем все категории которые активны
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getMainCategories() {

        /** Выбираем все активные категории из базы */
        $categories = Category::find()->where([static::ATTR_ENABLED => static::TRUE])->indexBy(static::ATTR_ID)->asArray()->all();

        /** Возвращаем AR объекты в виде массивов со всеми категориями */
        return $categories;
    }

    /**
     * Получаем родительскую категорию по ID в виде параметра
     *
     * @param int $id - ID категории
     *
     * @return array|ActiveRecord|null
     */
    public static function getCategoryById(int $id)
    {
        return Category::find()
            ->where([Category::ATTR_ID => $id])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->one();
    }

    /**
     * Получаем массив всех дочерних категорий, включенных и выключенных
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getChildCategories() {

        /** Выбираем все дочерние категории из базы */
        $Childcategories = Category::find()->andWhere(static::ATTR_PARENT_CATEGORY !== null)->indexBy(static::ATTR_ID)->asArray()->all();

        /** Возвращаем AR объекты в виде массивов с дочерними категориями */
        return $Childcategories;
    }

    /**
     * Связь для получения предметов лута, которые привязаны к категории
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::class, [Items::ATTR_PARENTCAT_ID => static::ATTR_ID]);
    }

    /**
     * Связь таблицы сама на себя - получаем родительскую категорию
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentcat()
    {
        return $this->hasOne(Category::class, [static::ATTR_ID => static::ATTR_PARENT_CATEGORY]);
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return CategoryQuery
     */
    public static function find(): CategoryQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new CategoryQuery(get_called_class());
    }

    /**
     * Получаем одну активную категорию по параметру - URL
     *
     * @param string $url
     * @return array|ActiveRecord|null
     */
    public static function getActiveCategoryByUrl(string $url)
    {
        return static::find()
            ->where([static::ATTR_URL => $url])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->one();
    }
}