<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
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
 *
 * @property CatSkills $category0
 */
class Skills extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID            = 'id';
    const ATTR_TITLE         = 'title';
    const ATTR_CATEGORY      = 'category';
    const ATTR_URL           = 'url';
    const ATTR_ENABLED       = 'enabled';
    const ATTR_DESCRIPTION   = 'description';
    const ATTR_KEYWORDS      = 'keywords';
    const ATTR_PREVIEW       = 'preview';
    const ATTR_CONTENT       = 'content';
    const ATTR_SHORT_DESC    = 'short_desc';

    /** Константы связей таблицы */
    const RELATION_CATEGORY0 = 'category0';

    /** @var string $file - Переменная файла превьюшки null */
    public $file;
    const FILE = 'file';

    /** Константы True/False для различных поисков */
    const TRUE  = 1;
    const FALSE = 0;
    
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
                ExistValidator::ATTR_TARGET_CLASS => CatSkills::class,
                ExistValidator::ATTR_TARGET_ATTRIBUTE =>
                    [static::ATTR_CATEGORY => CatSkills::ATTR_ID]
            ],

            [static::FILE, FileValidator::class, FileValidator::ATTR_EXTENSIONS => 'image']
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

    /*** Загрузка и сохранение превьюшек умений ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(68, 69))->save($catalog , ['quality' => 90]);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Catskills::class, ['id' => 'category']);
    }

    /** Получаем список всех предметов из таблицы справочника лута **/
    public function getAllItems() {
        $Items = Skills::find()->asArray()->all();
        return $Items;
    }

    /**
     *
     *
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
            ->andWhere(['category' => $id])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->asArray()
            ->all();
    }

}
