<?php

namespace app\models;

use app\common\services\files\ImageService;
use app\models\queries\NewsQuery;
use yii\base\Model;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\StringValidator;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
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
class News extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID          = 'id';
    public const ATTR_TITLE       = 'title';
    public const ATTR_URL         = 'url';
    public const ATTR_PREVIEW     = 'preview';
    public const ATTR_CONTENT     = 'content';
    public const ATTR_DATE_CREATE = 'date_create';
    public const ATTR_ENABLED     = 'enabled';
    public const ATTR_DESCRIPTION = 'description';
    public const ATTR_KEYWORDS    = 'keywords';
    public const ATTR_SHORTDESC   = 'shortdesc';

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    public const FILE = 'file';

    /** Константы True/False для различных поисков */
    public const TRUE  = 1;
    public const FALSE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
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
            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => 150],

            [static::ATTR_DESCRIPTION, RequiredValidator::class],
            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_KEYWORDS, RequiredValidator::class],
            [static::ATTR_KEYWORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_SHORTDESC, RequiredValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_PREVIEW, StringValidator::class, StringValidator::ATTR_MAX => 100]
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
            static::ATTR_TITLE => 'Название новости',
            static::ATTR_URL => 'Url-адрес',
            static::ATTR_PREVIEW => 'Превьюшка новости',
            static::ATTR_CONTENT => 'Содержимое',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_ENABLED => 'Новость активна',
            static::ATTR_DESCRIPTION => 'Метатег description',
            static::ATTR_KEYWORDS => 'Метатег keywords',
            static::ATTR_SHORTDESC => 'Краткое описание',
            static::FILE => 'Превьюшка новости'
        ];
    }

    /**
     * Загрузка и сохранение превьюшки новости
     *
     * @return Model
     */
    public function uploadPreview(): Model
    {
        return ImageService::uploadFile($this, static::FILE);
    }

    /**
     * Возвращаем активную новость по параметру url
     *
     * @param $id - url адрес
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function findActiveNewsByUrl($id)
    {
        return static::find()
            ->where([static::ATTR_URL=>$id])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->One();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return NewsQuery
     */
    public static function find(): NewsQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new NewsQuery(get_called_class());
    }

    /**
     * Запрос на получение всех активных новостей
     * Для последующей передачи в конструктор пагинации
     *
     * @return NewsQuery
     */
    public static function getActiveNewsQuery(): NewsQuery
    {
        return static::find()->andWhere([static::ATTR_ENABLED => static::TRUE]);
    }
}