<?php

namespace app\models;

use app\common\services\files\ImageService;
use app\models\queries\DoorkeysQuery;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Query;
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
class Doorkeys extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID           = 'id';
    public const ATTR_NAME         = 'name';
    public const ATTR_MAPGROUP     = 'mapgroup';
    public const ATTR_CONTENT      = 'content';
    public const ATTR_ACTIVE       = 'active';
    public const ATTR_DATE_CREATE  = 'date_create';
    public const ATTR_PREVIEW      = 'preview';
    public const ATTR_SHORTCONTENT = 'shortcontent';
    public const ATTR_URL          = 'url';
    public const ATTR_DESCRIPTION  = 'description';
    public const ATTR_KEYWORDS     = 'keywords';

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    public const FILE = 'file';

    /** @var string $doorkey - Переменная doorkey */
    public $doorkey;
    public const DOORKEY = 'doorkey';

    /** Константы True/False для различных поисков */
    const TRUE  = 1;
    const FALSE = 0;

    /** @var string Заглушка имени форм */
    public const formName = 'Doorkeys';
    
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
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_NAME, RequiredValidator::class],
            [static::ATTR_NAME, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DESCRIPTION, RequiredValidator::class],

            [static::ATTR_KEYWORDS, RequiredValidator::class],

            [static::ATTR_PREVIEW, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH_HUNDRED],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_SHORTCONTENT, StringValidator::class],

            [static::ATTR_URL, StringValidator::class],

            [static::ATTR_ACTIVE, IntegerValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_MAPGROUP, SafeValidator::class],

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

    /**
     * Загрузка и сохранение превьюшки ключа
     *
     * @return Model
     */
    public function uploadPreview(): Model
    {
        return ImageService::uploadFile($this, static::FILE);
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

    /**
     * Возвращаем массив объектов ключей по переданному значению
     *
     * @param string $category - Категория ключа
     *
     * @return ActiveRecord[]
     */
    public static function takeKeysByCategory(string $category)
    {
        return static::find()
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->andWhere(['like', static::ATTR_MAPGROUP, $category])
            ->orderby([static::ATTR_NAME => SORT_STRING])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();
    }

    /**
     * Возвращаем массив объектов активных ключей
     *
     * @return ActiveRecord[]
     */
    public static function takeActiveKeys()
    {
        return static::find()
            ->where([static::ATTR_ACTIVE => static::TRUE])
            ->orderby([static::ATTR_NAME => SORT_STRING])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->all();
    }

    /**
     * Получаем 20 активных ключей от Завода
     *
     * @return array|ActiveRecord[]
     */
    public static function takeActiveZavodKeys()
    {
        return static::find()
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->andWhere(['like', static::ATTR_MAPGROUP, ['Завод']])
            ->asArray()->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->orderby([static::ATTR_NAME => SORT_STRING])
            ->limit(20)
            ->all();
    }

    /**
     * Получаем 20 активных ключей от Леса
     *
     * @return array|ActiveRecord[]
     */
    public static function takeActiveForestKeys()
    {
        return static::find()
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->andWhere(['like', static::ATTR_MAPGROUP, ['Лес']])
            ->asArray()->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->orderby([static::ATTR_NAME => SORT_STRING])
            ->limit(20)
            ->all();
    }

    /**
     * Получаем 20 активных ключей от Берега
     *
     * @return array|ActiveRecord[]
     */
    public static function takeActiveBeregKeys()
    {
        return static::find()
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->andWhere(['like', static::ATTR_MAPGROUP, ['Берег']])
            ->asArray()->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->orderby([static::ATTR_NAME => SORT_STRING])
            ->limit(20)
            ->all();
    }

    /**
     * Получаем 20 активных ключей от Таможни
     *
     * @return array|ActiveRecord[]
     */
    public static function takeActiveTamojnyaKeys()
    {
        return static::find()
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->andWhere(['like', static::ATTR_MAPGROUP, ['Таможня']])
            ->asArray()->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->orderby([static::ATTR_NAME => SORT_STRING])
            ->limit(20)
            ->all();
    }

    /**
     * Получаем 20 активных ключей от Развязки
     *
     * @return array|ActiveRecord[]
     */
    public static function takeActiveRazvyazkaKeys()
    {
        return static::find()
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->andWhere(['like', static::ATTR_MAPGROUP, ['Развязка']])
            ->asArray()->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->orderby([static::ATTR_NAME => SORT_STRING])
            ->limit(20)
            ->all();
    }

    /**
     * Получаем 20 активных ключей от Лаборатории
     *
     * @return array|ActiveRecord[]
     */
    public static function takeActiveLaboratoryKeys()
    {
        return static::find()
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->andWhere(['like', static::ATTR_MAPGROUP, ['Лаборатория Terra Group']])
            ->asArray()->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->orderby([static::ATTR_NAME => SORT_STRING])
            ->limit(20)
            ->all();
    }

    /**
     * Массив дефолтных загрузок на странице ключей, если категория искогомого ключа
     * не оказалась явно указанной (Не сабмитнули форму)
     *
     * @param Doorkeys $formModel - AR объект ключей
     *
     * @return array
     */
    public static function KeysDefaultRenderingArray(Doorkeys $formModel): array
    {
        return [
            'terralab'=> static::takeActiveLaboratoryKeys(),
            'zavod'=> static::takeActiveZavodKeys(),
            'forest'=> static::takeActiveForestKeys(),
            'bereg'=> static::takeActiveBeregKeys(),
            'tamojnya'=> static::takeActiveTamojnyaKeys(),
            'razvyazka' => static::takeActiveRazvyazkaKeys(),
            'form_model' => $formModel
        ];
    }

    /**
     * Получаем активный ключ по параметру URL
     *
     * @param string $id - url адрес
     * @return array|ActiveRecord|null
     */
    public static function findActiveKeyByUrl(string $id)
    {
        return static::find()
            ->where([static::ATTR_URL=>$id])
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->cache(Yii::$app->params['cacheTime']['one_hour'])
            ->One();
    }

    /**
     * Метод возвращает объект запроса для последующего использования в JsondataService
     *
     * @param string $title - Поисковый запрос
     * @return Query
     */
    public static function getKeysForSelectSearch(string $title): Query
    {
        /** Объект запроса к БД */
        $query = new Query;

        /** Выбираем нужные данные с кешируемым запросом */
        $query->select([static::ATTR_NAME, static::ATTR_MAPGROUP, static::ATTR_PREVIEW, static::ATTR_URL])
            ->from(static::tableName())
            ->where(static::ATTR_NAME . ' LIKE "%' . $title . '%"')
            ->orWhere(static::ATTR_KEYWORDS . ' LIKE "%' . $title . '%"')
            ->andWhere([static::ATTR_ACTIVE => static::TRUE])
            ->orderBy(static::ATTR_NAME)
            ->cache(Yii::$app->params['cacheTime']['one_hour']);
        
        /** Возвращаем объект запроса к БД */
        return $query;
    }
    

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return DoorkeysQuery
     */
    public static function find(): DoorkeysQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new DoorkeysQuery(get_called_class());
    }
}