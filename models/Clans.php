<?php

namespace app\models;

use app\common\helpers\validators\UrlValidator;
use app\models\queries\ClansQuery;
use yii\db\Query;
use yii\web\UploadedFile;
use yii\imagine\Image;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "clans".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $preview
 * @property string $link
 * @property string $date_create
 * @property string $date_update
 * @property int $moderated
 */
class Clans extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID          = 'id';
    public const ATTR_TITLE       = 'title';
    public const ATTR_DESCRIPTION = 'description';
    public const ATTR_PREVIEW     = 'preview';
    public const ATTR_LINK        = 'link';
    public const ATTR_DATE_CREATE = 'date_create';
    public const ATTR_DATE_UPDATE = 'date_update';
    public const ATTR_MODERATED   = 'moderated';

    /** @var string $searchclan - Переменная для поиска клана */
    public $searchclan;
    public const SEARCHCLAN = 'searchclan';

    /** @var string $file - Переменная файла превьюшки */
    public $file;
    public const FILE = 'file';

    /** Константы bool значений */
    public const TRUE = 1;
    public const FALSE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clans';
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
            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => 100],

            [static::ATTR_DESCRIPTION, RequiredValidator::class],
            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            /** Валидация ссылки на клан или сообщество */
            [static::ATTR_LINK, RequiredValidator::class],
            [static::ATTR_LINK, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],
            [static::ATTR_LINK, UrlValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_DATE_UPDATE, SafeValidator::class],

            [static::ATTR_MODERATED, IntegerValidator::class],

            [static::FILE, FileValidator::class, FileValidator::ATTR_EXTENSIONS => ['png','jpg']]
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
            static::ATTR_TITLE => 'Название клана',
            static::ATTR_DESCRIPTION => 'Краткое описание клана',
            static::ATTR_PREVIEW => 'Превью клана',
            static::FILE => 'Превью клана',
            static::ATTR_LINK => 'Ссылка на сообщество клана',
            static::ATTR_DATE_CREATE => 'Дата регистрации',
            static::ATTR_MODERATED => 'Модерация пройдена',
            static::SEARCHCLAN => 'Поиск клана по названию',
            static::ATTR_DATE_UPDATE => 'Дата обновления'
        ];
    }

    /*** Загрузка и сохранение логотипов кланов ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {

            $catalog = 'img/admin/resized/clans/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->save($catalog , ['quality' => 70]);

            $imginfo = getimagesize($_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . $this->preview);

            // Проверяем размеры изображения, если они некорректны - то удаляем его.
            if($imginfo[0] !== 100 && $imginfo[1] !== 100) {
                unlink('./'.$this->preview);
                return false;
            }
        }
    }

    /**
     * Метод возвращает объект запроса для последующего использования в JsondataService
     *
     * @param string $title - Поисковый запрос
     * @return Query
     */
    public static function getClansForSelectSearch(string $title)
    {
        /** Преподгатавливаем переменную для запроса к БД */
        $query = new Query;

        /** Определяем запрос и ищем клан по названию */
        $query->select([static::ATTR_TITLE, static::ATTR_DESCRIPTION, static::ATTR_PREVIEW, static::ATTR_LINK, static::ATTR_DATE_CREATE])
            ->from(static::tableName())
            ->where(static::ATTR_TITLE . ' LIKE "%' . $title . '%"')
            ->andWhere([static::ATTR_MODERATED => static::TRUE])
            ->orderBy( static::ATTR_DATE_CREATE .' DESC')
            ->limit(30)
            ->cache(Yii::$app->params['cacheTime']['one_minute']);

        /** Возвращаем объект запроса к БД */
        return $query;
    }
    
    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return ClansQuery
     */
    public static function find(): ClansQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new ClansQuery(get_called_class());
    }
}