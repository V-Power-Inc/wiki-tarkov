<?php

namespace app\models;

use app\common\services\files\ImageService;
use app\models\queries\SkillsQuery;
use yii\base\Model;
use app\common\helpers\validators\UniqueValidator;
use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\ExistValidator;
use Yii;
use yii\db\ActiveRecord;

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
 * @property string $date_update
 *
 * @property CatSkills $category0
 */
class Skills extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID            = 'id';
    public const ATTR_TITLE         = 'title';
    public const ATTR_CATEGORY      = 'category';
    public const ATTR_URL           = 'url';
    public const ATTR_ENABLED       = 'enabled';
    public const ATTR_DESCRIPTION   = 'description';
    public const ATTR_KEYWORDS      = 'keywords';
    public const ATTR_PREVIEW       = 'preview';
    public const ATTR_CONTENT       = 'content';
    public const ATTR_SHORT_DESC    = 'short_desc';
    public const ATTR_DATE_UPDATE = 'date_update';

    /** @var string $file - Переменная файла превьюшки null */
    public $file;
    public const FILE = 'file';

    /** Константы True/False для различных поисков */
    public const TRUE  = 1;
    public const FALSE = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills';
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

            [static::ATTR_CATEGORY, IntegerValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_SHORT_DESC, StringValidator::class],

            [static::ATTR_URL, UniqueValidator::class, UniqueValidator::ATTR_MESSAGE => 'Значение url не является уникальным'],
            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_KEYWORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_PREVIEW, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_CATEGORY,
                ExistValidator::class,
                ExistValidator::ATTR_SKIP_ON_ERROR => true,
                ExistValidator::ATTR_TARGET_CLASS => Catskills::class,
                ExistValidator::ATTR_TARGET_ATTRIBUTE =>
                    [static::ATTR_CATEGORY => Catskills::ATTR_ID]
            ],

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

    /**
     * Загрузка и сохранение превьюшки умения
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
    public function getCategory()
    {
        return $this->hasOne(Catskills::class, ['id' => 'category']);
    }

    /** Получаем список всех предметов из таблицы справочника лута **/
    public function getAllItems() {
        $Items = Skills::find()->asArray()->all();
        return $Items;
    }

    /**
     * Метод находит активное умение по параметру URL и возвращает ActiveRecord запись
     *
     * @param $url - url адрес
     * @return array|ActiveRecord|null
     */
    public static function takeSkillByUrl($url)
    {
        return static::find()
            ->where([static::ATTR_URL=>$url])
            ->andWhere([static::ATTR_ENABLED => 1])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->One();
    }

    /**
     * Получаем список категорий по родительской категории
     * фильтрация на enabled реализована во вьюхе
     *
     * @param int $id
     * @return array|ActiveRecord[]
     */
    public static function takeSkillByCategoryId(int $id)
    {
        return static::find()
            ->andWhere([static::ATTR_CATEGORY => $id])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->asArray()
            ->all();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return SkillsQuery
     */
    public static function find(): SkillsQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new SkillsQuery(get_called_class());
    }
}