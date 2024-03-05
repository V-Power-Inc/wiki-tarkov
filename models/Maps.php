<?php

namespace app\models;

use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\NumberValidator;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;
use app\common\services\files\ImageService;
use app\models\queries\MapsQuery;
use yii\base\Model;
use yii\db\ActiveRecord;
use Yii;

/**
 * Active Record модель таблицы с маркерами локаций
 *
 * @property int $id ID primary key
 * @property string $name Название маркера
 * @property string $map Название карты для маркера
 * @property string $marker_group Группа маркера
 * @property double $coords_x Координаты маркера по оси X
 * @property double $coords_y Координаты маркера по оси Y
 * @property string $content Содержимое маркера
 * @property int $enabled Активность маркера
 * @property string $customicon Кастомная иконка маркера
 * @property string $exits_group Группа выхода с локации
 * @property int $exit_anyway Флаг активности выходы с локации с 2-х сторон
 * @property string $date_update Дата создания маркера
 */
class Maps extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID           = 'id';
    const ATTR_NAME         = 'name';
    const ATTR_MAP          = 'map';
    const ATTR_MARKER_GROUP = 'marker_group';
    const ATTR_COORDS_X     = 'coords_x';
    const ATTR_COORDS_Y     = 'coords_y';
    const ATTR_CONTENT      = 'content';
    const ATTR_ENABLED      = 'enabled';
    const ATTR_CUSTOMICON   = 'customicon';
    const ATTR_EXITS_GROUP  = 'exits_group';
    const ATTR_EXIT_ANYWAY  = 'exit_anyway';
    const ATTR_DATE_UPDATE  = 'date_update';

    /** Константы существующих локаций */
    const MAP_ZAVOD      = 'Завод';
    const MAP_BEREG      = 'Берег';
    const MAP_TAMOJNYA   = 'Таможня';
    const MAP_LABORATORY = 'Лаборатория';
    const MAP_FOREST     = 'Лес';
    const MAP_RAZVYAZKA  = 'Развязка';

    /** Константы True/False для различных поисков */
    const TRUE  = 1;
    const FALSE = 0;

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    const FILE = 'file';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maps';
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

            [static::ATTR_NAME, RequiredValidator::class],
            [static::ATTR_NAME, StringValidator::class, StringValidator::ATTR_MAX => 100],

            [static::ATTR_MAP, RequiredValidator::class],
            [static::ATTR_MAP, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

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
            static::ATTR_MAP => 'Локация маркера',
            static::ATTR_MARKER_GROUP => 'Группа маркера',
            static::ATTR_COORDS_X => 'Координаты по оси X',
            static::ATTR_COORDS_Y => 'Координаты по оси Y',
            static::ATTR_CONTENT => 'Содержание',
            static::ATTR_CUSTOMICON => 'Иконка маркера',
            static::ATTR_EXITS_GROUP => 'Спавн был в зоне',
            static::ATTR_ENABLED => 'Включен',
            static::ATTR_EXIT_ANYWAY => 'Общий выход',
            static::ATTR_DATE_UPDATE => 'Дата обновления',
            static::FILE => 'Иконка маркера'
        ];
    }

    /**
     * Загрузка и сохранение иконки интерактивных карт локаций
     *
     * @return Model
     */
    public function uploadPreview(): Model
    {
        return ImageService::uploadFile($this, static::FILE);
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return MapsQuery
     */
    public static function find(): MapsQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new MapsQuery(get_called_class());
    }

    /**
     * Получаем список активных маркеров для Леса
     *
     * @return array
     */
    public static function takeForestMarkers(): array
    {
        return static::find()
            ->asArray()
            ->where([static::ATTR_MAP => static::MAP_FOREST])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();
    }

    /**
     * Получаем список активных маркеров для Завода
     *
     * @return array
     */
    public static function takeZavodMarkers(): array
    {
        return static::find()
            ->asArray()
            ->where([static::ATTR_MAP => static::MAP_ZAVOD])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();
    }

    /**
     * Получаем список активных маркеров для Таможни
     *
     * @return array
     */
    public static function takeTamojnyaMarkers(): array
    {
        return static::find()
            ->asArray()
            ->where([static::ATTR_MAP => static::MAP_TAMOJNYA])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();
    }

    /**
     * Получаем список активных маркеров для Лаборатории
     *
     * @return array
     */
    public static function takeLaboratoryMarkers(): array
    {
        return static::find()
            ->asArray()
            ->where([static::ATTR_MAP => static::MAP_LABORATORY])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();
    }

    /**
     * Получаем список активных маркеров для Развязки
     *
     * @return array
     */
    public static function takeRazvyazkaMarkers(): array
    {
        return static::find()
            ->asArray()
            ->where([static::ATTR_MAP => static::MAP_RAZVYAZKA])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();
    }

    /**
     * Получаем список активных маркеров для Берега
     *
     * @return array
     */
    public static function takeBeregMarkers(): array
    {
        return static::find()
            ->asArray()
            ->where([static::ATTR_MAP => static::MAP_BEREG])
            ->andWhere([static::ATTR_ENABLED => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();
    }
}