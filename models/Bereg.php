<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\NumberValidator;
use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\models\queries\BeregQuery;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "bereg".
 *
 * @property integer $id
 * @property string $name
 * @property string $marker_group
 * @property double $coords_x
 * @property double $coords_y
 * @property string $content
 * @property integer $enabled
 * @property string $customicon
 * @property string $exits_group
 * @property integer $exit_anyway
 * @property string $date_update
 */
class Bereg extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID           = 'id';
    const ATTR_NAME         = 'name';
    const ATTR_MARKER_GROUP = 'marker_group';
    const ATTR_COORDS_X     = 'coords_x';
    const ATTR_COORDS_Y     = 'coords_y';
    const ATTR_CONTENT      = 'content';
    const ATTR_ENABLED      = 'enabled';
    const ATTR_CUSTOMICON   = 'customicon';
    const ATTR_EXITS_GROUP  = 'exits_group';
    const ATTR_EXIT_ANYWAY  = 'exit_anyway';
    const ATTR_DATE_UPDATE  = 'date_update';

    /** Константы True/False для различных поисков */
    const TRUE  = 1;
    const FALSE = 0;

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    const FILE = 'file';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bereg';
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
            [static::ATTR_NAME, StringValidator::class, StringValidator::ATTR_MAX => 100],

            [static::ATTR_COORDS_X, NumberValidator::class],

            [static::ATTR_COORDS_Y, NumberValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_EXIT_ANYWAY, IntegerValidator::class],

            [static::ATTR_EXITS_GROUP, StringValidator::class, StringValidator::ATTR_MAX => 100],

            [static::ATTR_MARKER_GROUP, StringValidator::class, StringValidator::ATTR_MAX => 50],

            [static::ATTR_CUSTOMICON, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DATE_UPDATE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

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
            static::ATTR_NAME => 'Имя маркера',
            static::ATTR_MARKER_GROUP => 'Группа маркера',
            static::ATTR_COORDS_X => 'Координаты по оси X',
            static::ATTR_COORDS_Y => 'Координаты по оси Y',
            static::ATTR_CONTENT => 'Содержание',
            static::ATTR_CUSTOMICON => 'Иконка маркера',
            static::ATTR_EXITS_GROUP => 'Спавн был в зоне',
            static::ATTR_ENABLED => 'Включен',
            static::ATTR_EXIT_ANYWAY => 'Общий выход',
            static::FILE => 'Иконка маркера'
        ];
    }

    /*** Загрузка и сохранение превьюшек маркера ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/beregicons/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->customicon = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }

    /**
     * Получаем список активных маркеров для данной интерактивной карты
     *
     * @return array
     */
    public static function takeMarkers(): array
    {
        return static::find()
            ->asArray()
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return BeregQuery
     */
    public static function find(): BeregQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new BeregQuery(get_called_class());
    }
}