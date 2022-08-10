<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Yii;

/**
 * This is the model class for table "traders".
 *
 * @property integer $id
 * @property string $title
 * @property string $preview
 * @property string $content
 * @property string $urltoquets
 * @property string $button_quests
 * @property string $button_detail
 * @property string $bg_style
 * @property string $fullcontent
 * @property string $description
 * @property string $keywords
 * @property string $url
 * @property integer $sortir
 * @property integer $enabled
 */
class Traders extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID            = 'id';
    const ATTR_TITLE         = 'title';
    const ATTR_PREVIEW       = 'preview';
    const ATTR_CONTENT       = 'content';
    const ATTR_URLTOQUESTS   = 'urltoquests';
    const ATTR_BUTTON_QUESTS = 'button_quests';
    const ATTR_BUTTON_DETAIL = 'button_detail';
    const ATTR_BG_STYLE      = 'bg_style';
    const ATTR_FULLCONTENT   = 'fullcontent';
    const ATTR_DESCRIPTION   = 'description';
    const ATTR_KEYWORDS      = 'keywords';
    const ATTR_URL           = 'url';
    const ATTR_SORTIR        = 'sortir';
    const ATTR_ENABLED       = 'enabled';

    /** @var string $file - Переменная файла превьюшки */
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
        return 'traders';
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

            [static::ATTR_SORTIR, RequiredValidator::class],
            [static::ATTR_SORTIR, IntegerValidator::class],

            [static::ATTR_BG_STYLE, StringValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_FULLCONTENT, StringValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_PREVIEW, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_URLTOQUESTS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_BUTTON_QUESTS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_BUTTON_DETAIL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_KEYWORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

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
            static::ATTR_TITLE => 'Имя торговца',
            static::ATTR_PREVIEW => 'Превьюшка торговца',
            static::ATTR_CONTENT => 'Содержимое',
            static::ATTR_URLTOQUESTS => 'Ссылка на квесты',
            static::ATTR_BUTTON_QUESTS => 'Надпись на ссылке квестов',
            static::ATTR_BUTTON_DETAIL => 'Надпись на ссылке детальной страницы',
            static::ATTR_BG_STYLE => 'Фон блока',
            static::ATTR_ENABLED => 'Активен',
            static::ATTR_SORTIR => 'Сортировка',
            static::ATTR_FULLCONTENT => 'Детальное содержимое',
            static::ATTR_DESCRIPTION => 'SEO описание',
            static::ATTR_KEYWORDS => 'SEO ключевые слова',
            static::ATTR_URL => 'Адрес детального раздела торговца',
            static::FILE => 'Файл превьюшки'
        ];
    }

    /*** Загрузка и сохранение превьюшек торговца ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(130, 130))->save($catalog , ['quality' => 90]);
        }
    }

    /**
     * Получаем всех активных торговцев
     *
     * @return array
     */
    public static function takeTraders(): array
    {
        return static::find()->where([static::ATTR_ENABLED => static::TRUE])->orderby([static::ATTR_SORTIR=>SORT_ASC])->cache(Yii::$app->params['cacheTime']['one_hour'])->asArray()->all();
    }

    /**
     * Ищем активного торговца по параметру url
     *
     * @param string $url - url параметр (строка)
     * @return array
     */
    public static function takeTraderByUrl(string $url): array
    {
        return static::find()->where([static::ATTR_URL=>$url])->andWhere([static::ATTR_ENABLED => 1])->cache(Yii::$app->params['cacheTime']['one_hour'])->One();
    }

}
