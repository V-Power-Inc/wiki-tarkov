<?php

namespace app\models;

use app\common\services\files\ImageService;
use app\models\queries\CatskillsQuery;
use yii\base\Model;
use app\common\helpers\validators\UniqueValidator;
use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "cat_skills".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $sortir
 * @property string $url
 * @property string $description
 * @property string $keywords
 * @property integer $enabled
 * @property string $preview
 * @property string $bg_style
 *
 * @property Skills[] $skills
 */
class Catskills extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID          = 'id';
    public const ATTR_TITLE       = 'title';
    public const ATTR_CONTENT     = 'content';
    public const ATTR_SORTIR      = 'sortir';
    public const ATTR_URL         = 'url';
    public const ATTR_DESCRIPTION = 'description';
    public const ATTR_KEYWORDS    = 'keywords';
    public const ATTR_ENABLED     = 'enabled';
    public const ATTR_PREVIEW     = 'preview';
    public const ATTR_BG_STYLE    = 'bg_style';

    /** Константы связей таблицы */
    const RELATION_SKILLS  = 'skills';

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    public const FILE = 'file';

    /** Константы bool значений */
    public const TRUE = 1;
    public const FALSE = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_skills';
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

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_BG_STYLE, StringValidator::class],

            [static::ATTR_URL, UniqueValidator::class, UniqueValidator::ATTR_MESSAGE => 'Значение url не является уникальным'],

            [static::ATTR_SORTIR, IntegerValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_KEYWORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_PREVIEW, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::FILE, FileValidator::class, FileValidator::ATTR_EXTENSIONS => "jpg,png,jpeg"]
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
            static::ATTR_TITLE => 'Название категории',
            static::ATTR_CONTENT => 'Содержимое категории',
            static::ATTR_SORTIR => 'Сортировка категории',
            static::ATTR_URL => 'Url категории',
            static::ATTR_DESCRIPTION => 'SEO описание категории',
            static::ATTR_KEYWORDS => 'SEO ключевые слова',
            static::ATTR_ENABLED => 'Категория активна',
            static::ATTR_PREVIEW => 'Превьюшка категории',
            static::ATTR_BG_STYLE => 'Цвет фона',
            static::FILE => 'Превьюшка категории'
        ];
    }

    /**
     * Загрузка и сохранение превьюшки категории умений
     *
     * @return Model
     */
    public function uploadPreview(): Model
    {
        return ImageService::uploadFile($this, static::FILE);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skills::class, [Skills::ATTR_CATEGORY => static::ATTR_ID]);
    }

    /**
     * Возвращаем все активные категории навыков
     *
     * @return array|ActiveRecord[]
     */
    public static function takeActiveCatSkills()
    {
        return static::find()
            ->where([static::ATTR_ENABLED => 1])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->asArray()
            ->all();
    }

    /**
     * Получаем активную категорию умений по url адресу
     *
     * @param string $name - url адрес
     * @return array|ActiveRecord|null
     */
    public static function takeActiveCategoryByUrl(string $name)
    {
        return static::find()
            ->where([static::ATTR_URL=>$name])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->One();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return CatskillsQuery
     */
    public static function find(): CatskillsQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new CatskillsQuery(get_called_class());
    }
}