<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Yii;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\FileValidator;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "baraholshik".
 *
 * @property int $id
 * @property int $tab_number
 * @property string $title
 * @property string $content
 * @property string $date_create
 * @property string $date_edit
 * @property string $preview
 */
class Baraholshik extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID          = 'id';
    const ATTR_TAB_NUMBER  = 'tab_number';
    const ATTR_TITLE       = 'title';
    const ATTR_CONTENT     = 'content';
    const ATTR_DATE_CREATE = 'date_create';
    const ATTR_DATE_EDIT   = 'date_edit';
    const ATTR_PREVIEW     = 'preview';

    /** @var string $file - Переменная файла превьюшки null  */
    public $file = null;
    const FILE = 'file';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'baraholshik';
    }

    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [static::ATTR_TAB_NUMBER, IntegerValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_DATE_EDIT, SafeValidator::class],

            [static::FILE, FileValidator::class, FileValidator::ATTR_EXTENSIONS => 'image'],

            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => 100],

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
            static::ATTR_TITLE => 'Название квеста',
            static::ATTR_CONTENT => 'Содержимое квеста',
            static::ATTR_TAB_NUMBER => 'Сортировка',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_DATE_EDIT => 'Дата последнего редактирования',
            static::ATTR_PREVIEW => 'Превью картинка квеста',
            static::FILE => 'Файл превьюшки'
        ];
    }

    /*** Загрузка и сохранение превьюшек квеста ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }

    /**
     * Получаем квесты данного торговца
     *
     * @return ActiveRecord[]
     */
    public static function takeQuestsBaraholshik()
    {
        return static::find()->orderby([static::ATTR_TAB_NUMBER=>SORT_ASC])->cache(Yii::$app->params['cacheTime']['one_hour'])->all();
    }

}
