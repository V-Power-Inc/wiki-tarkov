<?php

namespace app\models;

use app\common\services\files\ImageService;
use app\models\queries\ArticlesQuery;
use yii\base\Model;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\SafeValidator;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $preview
 * @property string $content
 * @property string $date_create
 * @property integer $enabled
 * @property string $description
 * @property string $keywords
 * @property string $shortdesc
 */
class Articles extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID          = 'id';
    const ATTR_TITLE       = 'title';
    const ATTR_URL         = 'url';
    const ATTR_PREVIEW     = 'preview';
    const ATTR_CONTENT     = 'content';
    const ATTR_DATE_CREATE = 'date_create';
    const ATTR_ENABLED     = 'enabled';
    const ATTR_DESCRIPTION = 'description';
    const ATTR_KEYWORDS    = 'keywords';
    const ATTR_SHORTDESC   = 'shortdesc';

    /** @var string $file - Переменная файла превьюшки null  */
    public $file = null;
    const FILE = 'file';

    /** @var int - Константы True/False для различных валидаций */
    const TRUE  = 1;
    const FALSE = 0;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
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

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_SHORTDESC, StringValidator::class],

            [static::ATTR_KEYWORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH_HUNDRED],

            [static::ATTR_PREVIEW, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH_TWO_HUNDRED]
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
            static::ATTR_TITLE => 'Заголовок статьи',
            static::ATTR_URL => 'Url адрес статьи',
            static::ATTR_PREVIEW => 'Превью картинка статьи',
            static::ATTR_CONTENT => 'Содержание',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_ENABLED => 'Статья активна',
            static::ATTR_DESCRIPTION => 'SEO Описание',
            static::ATTR_KEYWORDS => 'SEO ключевые слова',
            static::ATTR_SHORTDESC => 'Короткое описание',
            static::FILE => 'Превьюшка полезной статьи'
        ];
    }

    /**
     * Загрузка и сохранение превьюшки статьи
     *
     * @return Model
     */
    public function uploadPreview(): Model
    {
        return ImageService::uploadFile($this, self::FILE);
    }

    /**
     * Возвращаем активную полезную статью по url параметру
     *
     * @param string $url - GET параметр
     * @return array|ActiveRecord|null
     */
    public static function takeActiveArticleByUrl(string $url)
    {
        return Articles::find()
            ->where([static::ATTR_URL => $url])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->One();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return ArticlesQuery
     */
    public static function find(): ArticlesQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new ArticlesQuery(get_called_class());
    }
}