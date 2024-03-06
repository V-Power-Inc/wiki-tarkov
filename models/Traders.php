<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\StringValidator;
use app\common\services\files\ImageService;
use app\models\queries\TradersQuery;
use yii\base\Model;
use yii\db\ActiveRecord;
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
class Traders extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID            = 'id';
    const ATTR_TITLE         = 'title';
    const ATTR_PREVIEW       = 'preview';
    const ATTR_CONTENT       = 'content';
    const ATTR_URLTOQUETS    = 'urltoquets';
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
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_TITLE, RequiredValidator::class],
            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_SORTIR, RequiredValidator::class],
            [static::ATTR_SORTIR, IntegerValidator::class],

            [static::ATTR_BG_STYLE, StringValidator::class],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_FULLCONTENT, StringValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class],

            [static::ATTR_PREVIEW, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_URLTOQUETS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_BUTTON_QUESTS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_BUTTON_DETAIL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_KEYWORDS, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::FILE, FileValidator::class, FileValidator::ATTR_EXTENSIONS => 'jpg,png,jpeg']
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
            static::ATTR_URLTOQUETS => 'Ссылка на квесты',
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

    /**
     * Возвращаем список всех торговцев в виде массива с одинаковыми ключом и значением
     * Может использовать в различного рода селектах
     *
     * @param bool $all_items - Флаг, указывает будет ли в массиве элемент (Все предметы)
     *
     * @return string[]
     */
    public static function getTradersList(bool $all_items = true): array
    {
        /** Массив торговцев */
        $array = [
            "Все предметы" => "Все предметы",
            'Прапор' => 'Прапор',
            'Терапевт' => 'Терапевт',
            'Скупщик' => 'Скупщик',
            'Лыжник' => 'Лыжник',
            'Миротворец' => 'Миротворец',
            'Механик' => 'Механик',
            'Барахольщик' => 'Барахольщик',
            'Егерь' => 'Егерь'
        ];

        /** Если в метод прилетел флаг false */
        if ($all_items === false) {

            /** Убираем из массива первый элемент (Все предметы) */
            array_shift($array);
        }

        /** Возвращаем массив торговцев */
        return $array;
    }

    /**
     * Загрузка и сохранение превьюшки торговца
     *
     * @return Model
     */
    public function uploadPreview(): Model
    {
        return ImageService::uploadFile($this, static::FILE);
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
     * @return ActiveRecord
     */
    public static function takeTraderByUrl(string $url): ? ActiveRecord
    {
        return static::find()->where([static::ATTR_URL=>$url])->andWhere([static::ATTR_ENABLED => 1])->cache(Yii::$app->params['cacheTime']['one_hour'])->One();
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return TradersQuery
     */
    public static function find(): TradersQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new TradersQuery(get_called_class());
    }
}