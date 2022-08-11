<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\StringValidator;

/**
 * This is the model class for table "doorkeys".
 *
 * @property integer $id
 * @property string $name
 * @property string $mapgroup
 * @property string $content
 * @property integer $active
 * @property string $date_create
 * @property string $preview
 * @property string $shortcontent
 * @property string $url
 * @property string $description
 * @property string $keywords
 */
class Doorkeys extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID           = 'id';
    const ATTR_NAME         = 'name';
    const ATTR_MAPGROUP     = 'mapgroup';
    const ATTR_CONTENT      = 'content';
    const ATTR_ACTIVE       = 'active';
    const ATTR_DATE_CREATE  = 'date_create';
    const ATTR_PREVIEW      = 'preview';
    const ATTR_SHORTCONTENT = 'shortcontent';
    const ATTR_URL          = 'url';
    const ATTR_DESCRIPTION  = 'description';
    const ATTR_KEYWORDS     = 'keywords';

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    const FILE = 'file';

    /** @var string $doorkey - Переменная doorkey */
    public $doorkey;
    const DOORKEY = 'doorkey';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doorkeys';
    }

    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [static::ATTR_NAME, RequiredValidator::class],
            [static::ATTR_NAME, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DESCRIPTION, RequiredValidator::class],

            [static::ATTR_KEYWORDS, RequiredValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_SHORTCONTENT, StringValidator::class],

            [static::ATTR_URL, StringValidator::class],

            [static::ATTR_ACTIVE, IntegerValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_MAPGROUP, SafeValidator::class],

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
            static::ATTR_NAME => 'Название ключа',
            static::ATTR_MAPGROUP => 'Используется на картах',
            static::ATTR_CONTENT => 'Содержание',
            static::ATTR_SHORTCONTENT => 'Краткое описание',
            static::ATTR_ACTIVE => 'Включен',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::FILE => 'Превьюшка ключа',
            static::ATTR_PREVIEW => 'Превьюшка ключа',
            static::ATTR_URL => 'Url адрес',
            static::ATTR_DESCRIPTION => 'Метатег description',
            static::ATTR_KEYWORDS => 'Метатег keywords',
            static::DOORKEY => ''
        ];
    }

    /** Преобразуем массив в строку для сохранения привязки ключей к нескольким локациям **/
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->mapgroup != null) {
                $this->mapgroup = implode(", ", $this->mapgroup);
            }
            return true;
        }
        return false;
    }

    /*** Загрузка и сохранение превьюшек квеста ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/doorkeys/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(64, 64))->save($catalog , ['quality' => 90]);
        }
    }

    /**
     * Метод возвращает массив ключей категорий, которые используются для поиска ключей по заданным параметрам
     *
     * @return array|string[]
     */
    public static function KeysCategories(): array
    {
        return [
            'Все ключи' => 'Все ключи',
            'Лаборатория Terra Group' => 'Лаборатория Terra Group',
            'Таможня' => 'Таможня',
            'Берег' => 'Берег',
            'Лес' => 'Лес',
            'Завод' => 'Завод',
            'Развязка' => 'Развязка',
            '3-х этажная общага на Таможне' => '3-х этажная общага на Таможне',
            '2-х этажная общага на Таможне' => '2-х этажная общага на Таможне',
            'Восточное крыло санатория' => 'Восточное крыло санатория',
            'Западное крыло санатория' => 'Западное крыло санатория',
            'Ключи от техники' => 'Ключи от техники',
            'Квестовые ключи' => 'Квестовые ключи',
            'Ключи от сейфов/помещений с сейфами' => 'Ключи от сейфов/помещений с сейфами',
        ];
    }

}
