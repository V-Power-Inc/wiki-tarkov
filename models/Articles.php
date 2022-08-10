<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\SafeValidator;

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
class Articles extends \yii\db\ActiveRecord
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
            [static::ATTR_TITLE, RequiredValidator::class],
            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DESCRIPTION, RequiredValidator::class],
            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_SHORTDESC, StringValidator::class],

            [static::ATTR_KEYWORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => 100],

            [static::ATTR_PREVIEW, StringValidator::class, StringValidator::ATTR_MAX => 200]
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
     * Загрузка и сохранение превьюшек квеста
     *
     * @return void
     */
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }
}
