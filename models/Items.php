<?php

namespace app\models;

use app\common\services\files\ImageService;
use app\models\queries\ItemsQuery;
use yii\base\Model;
use yii\db\Query;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\FileValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\ExistValidator;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "items".
 *
 * @property integer $id
 * @property string $title
 * @property string $preview
 * @property string $shortdesc
 * @property string $content
 * @property string $date_create
 * @property string $date_update
 * @property integer $active
 * @property string $url
 * @property string $description
 * @property string $keywords
 * @property integer $parentcat_id
 * @property integer $quest_item
 * @property string $trader_group
 * @property string $search_words
 * @property string $module_weapon
 * @property string $creator
 *
 * @property Category $parentcat
 * @property Category $maintcat
 */
class Items extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID            = 'id';
    public const ATTR_TITLE         = 'title';
    public const ATTR_PREVIEW       = 'preview';
    public const ATTR_SHORTDESC     = 'shortdesc';
    public const ATTR_CONTENT       = 'content';
    public const ATTR_DATE_CREATE   = 'date_create';
    public const ATTR_DATE_UPDATE   = 'date_update';
    public const ATTR_ACTIVE        = 'active';
    public const ATTR_URL           = 'url';
    public const ATTR_DESCRIPTION   = 'description';
    public const ATTR_KEYWORDS      = 'keywords';
    public const ATTR_PARENTCAT_ID  = 'parentcat_id';
    public const ATTR_QUEST_ITEM    = 'quest_item';
    public const ATTR_TRADER_GROUP  = 'trader_group';
    public const ATTR_SEARCH_WORDS  = 'search_words';
    public const ATTR_MODULE_WEAPON = 'module_weapon';
    public const ATTR_CREATOR       = 'creator';

    /** Константы связей таблицы */
    public const RELATION_PARENTCAT = 'parentcat';
    public const RELATION_MAINCAT   = 'maincat';

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    public const FILE = 'file';

    /** @var string $questitem - Переменная квестового предмета */
    public $questitem;
    public const QUESTITEM = 'questitem';

    /** Константы True/False для различных поисков */
    public const TRUE  = 1;
    public const FALSE = 0;

    /** @var string Заглушка имени форм */
    public const formName = 'Items';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
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

            [static::ATTR_SHORTDESC, RequiredValidator::class],
            [static::ATTR_SHORTDESC, StringValidator::class],

            [static::ATTR_URL, RequiredValidator::class],
            [static::ATTR_URL, StringValidator::class],

            [static::ATTR_DESCRIPTION, RequiredValidator::class],
            [static::ATTR_DESCRIPTION, StringValidator::class],

            [static::ATTR_CREATOR, RequiredValidator::class],
            [static::ATTR_CREATOR, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_SEARCH_WORDS, StringValidator::class],

            [static::ATTR_MODULE_WEAPON, StringValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_DATE_UPDATE, SafeValidator::class],

            [static::ATTR_KEYWORDS, SafeValidator::class],

            [static::ATTR_TRADER_GROUP, SafeValidator::class],

            [static::ATTR_QUEST_ITEM, SafeValidator::class],

            [static::ATTR_ACTIVE, IntegerValidator::class],

            [static::ATTR_PARENTCAT_ID, IntegerValidator::class],

            [static::ATTR_PREVIEW, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_PARENTCAT_ID,
                ExistValidator::class,
                ExistValidator::ATTR_SKIP_ON_ERROR => true,
                ExistValidator::ATTR_TARGET_CLASS => Category::class,
                ExistValidator::ATTR_TARGET_ATTRIBUTE =>
                    [static::ATTR_PARENTCAT_ID => Category::ATTR_ID]
            ],

            [static::FILE, FileValidator::class, FileValidator::ATTR_EXTENSIONS => "jpg,png,jpeg"]
        ];
    }

    /** Преобразуем массив в строку для сохранения привязки предмета лута к нескольким торговцам **/
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->trader_group != null) {
                $this->trader_group = implode(", ", $this->trader_group);
            }
            return true;
        }
        return false;
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
            static::ATTR_TITLE => 'Название',
            static::ATTR_PREVIEW => 'Превьюшка предмета',
            static::ATTR_SHORTDESC => 'Короткое описание',
            static::ATTR_CONTENT => 'Содержимое',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_ACTIVE => 'Лут активен',
            static::ATTR_PARENTCAT_ID => 'Родительская категория',
            static::ATTR_URL => 'URL адрес',
            static::ATTR_DESCRIPTION => 'SEO описание',
            static::ATTR_KEYWORDS => 'SEO ключевые слова',
            static::ATTR_TRADER_GROUP => 'Относится к торговцам',
            static::ATTR_QUEST_ITEM => 'Квестовый предмет',
            static::ATTR_MODULE_WEAPON => 'Оружия связанные с модулем',
            static::ATTR_SEARCH_WORDS => 'Слова синонимы (livesearch)',
            static::ATTR_DATE_UPDATE => 'Дата последнего обновления',
            static::ATTR_CREATOR => 'Создан пользователем',
            static::FILE => 'Превьюшка предмета',
            static::QUESTITEM => ''
        ];
    }

    /**
     * Загрузка и сохранение превьюшки предмета из справочника
     *
     * @return Model
     */
    public function uploadPreview(): Model
    {
        return ImageService::uploadFile($this, static::FILE);
    }

    /** Получаем список всех предметов из таблицы справочника лута **/
    public function getAllItems() {
        $Items = static::find()->asArray()->all();
        return $Items;
    }

    /** Получаем все активные предметы из справочника лута в виде массива **/
    public function getActiveItems() {
        $activeLoot = static::find()->where(['active' => 1])->asArray()->all();
        return $activeLoot;
    }

    /**
     * Ниже получаем родительскую категорию
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentcat()
    {
        return $this->hasOne(Category::class, ['id' => 'parentcat_id']);
    }

    /**
     * Получаем активный лут, связанный с текущей категорией, а также получаем родительскую категорию
     *
     * @param string $name - url алрес категории
     * @param int $id - id родительской категории
     * @return Query
     */
    public static function takeItemsWithParentCat(string $name, int $id): Query
    {
        return static::find()
            ->alias( 'i')
            ->select('i.*')
            ->leftJoin('category as c1', '`i`.`parentcat_id` = `c1`.`id`')
            ->andWhere(['c1.url' => $name])
            ->andWhere(['i.active' => 1])
            ->orWhere(['c1.parent_category' => $id])
            ->andWhere(['c1.enabled' => 1]);
    }

    /**
     * Получаем список всех активных квестовых предметов
     *
     * @return array|ActiveRecord[]
     */
    public static function takeActiveQuestItems()
    {
        return static::find()
            ->where([static::ATTR_ACTIVE => static::TRUE])
            ->andWhere([static::ATTR_QUEST_ITEM => static::TRUE])
            ->orderby([static::ATTR_TITLE => SORT_STRING])
            ->all();
    }

    /**
     * Получаем активные квестовые предметы по категории торговца
     *
     * @param string $category
     * @return array|ActiveRecord[]
     */
    public static function takeQuestItemsByTraderCat(string $category)
    {
        return static::find()
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->andWhere([static::ATTR_QUEST_ITEM => static::TRUE])
            ->andWhere(['like', static::ATTR_TRADER_GROUP, [$category]])
            ->orderby([static::ATTR_TITLE => SORT_STRING])
            ->all();
    }

    /**
     * Возвращаем активный предмет лута по параметру url
     * Ищем через like binary, чтобы исключить рендер дублей (разный регистр символов в строке)
     *
     * @param string $item - url параметр
     * @return array|ActiveRecord|null
     */
    public static function takeActiveItemByUrl(string $item)
    {
        return static::find()
            ->where(['like binary', static::ATTR_URL, $item])
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->one();
    }

    /**
     * Метод возвращает объект запроса для последующего использования в JsondataService
     *
     * @param string $title - Поисковый запрос
     * @return Query
     */
    public static function getItemsForSelectSearch(string $title): Query
    {
        /** Объект запроса к БД */
        $query = new Query;

        /** Выбираем нужные данные с кешируемым запросом */
        $query->select([static::ATTR_TITLE, static::ATTR_SHORTDESC, static::ATTR_PREVIEW, static::ATTR_URL, static::ATTR_PARENTCAT_ID, static::ATTR_SEARCH_WORDS])
            ->from(static::tableName())
            ->where(static::ATTR_TITLE . ' LIKE "%' . $title . '%"')
            ->orWhere(static::ATTR_SEARCH_WORDS . ' LIKE "%' . $title . '%"')
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->orderBy(static::ATTR_TITLE)
            ->cache(Yii::$app->params['cacheTime']['one_hour']);

        /** Возвращаем объект запроса к БД */
        return $query;
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return ItemsQuery
     */
    public static function find(): ItemsQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new ItemsQuery(get_called_class());
    }

    /**
     * Получаем запрос для формирования SQL на получение всех активных предметов справочника лута
     * Для последующей передачи в конструктор пагинации
     *
     * @return ItemsQuery
     */
    public static function getActiveItemsQuery(): ItemsQuery
    {
        return static::find()->where([static::ATTR_ACTIVE => static::TRUE]);
    }
}