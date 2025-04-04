<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 06.03.2023
 * Time: 1:08
 */

namespace app\common\models\tasks\db;

use app\common\constants\log\ErrorDesc;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\services\LogService;
use app\common\services\TradersService;
use app\models\Tasks;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\Json;
use Yii;

/**
 * Модель с атрибутами данных квестов, в которую данные предварительно сетапятся, перед загрузкой в AR
 * таблицу квестов из API
 *
 * Class TaskModel
 * @package app\common\models\tasks\db
 */
final class TaskModel extends Model
{
    /** @var string - Название квеста */
    public $quest;
    private const ATTR_QUEST = 'quest';

    /** @var string - Имя торговца */
    public $trader_name;
    private const ATTR_TRADER_NAME = 'trader_name';

    /** @var string - Иконка торговца */
    public $trader_icon;
    private const ATTR_TRADER_ICON = 'trader_icon';

    /** @var string - Строка с JSON данными о квесте (Содержит в себе полный набор данных) */
    public $json;
    private const ATTR_JSON = 'json';

    /** @var int - Флаг активности записи (0 - не активна / 1 - активна), по-умолчанию активна */
    public $active = 1;
    private const ATTR_ACTIVE = 'active';

    /** @var int - Флаг устаревания записи (0 - актуальна / 1 - не актуальна), по-умолчанию актуальна */
    public $old = 0;
    private const ATTR_OLD = 'old';

    /** @var string - Url до квестов торговца */
    public $url;
    private const ATTR_URL = 'url';

    /** @var string - Ключ массива с информацией о торговце */
    private const TRADER = 'trader';

    /**
     * В конструкторе сетапим атрибутам текущей модели данные о квесте, если прилетел массив
     * если же массива не было, конструктор ничего делать не будет
     *
     * TaskModel constructor.
     * @param array $config
     * @param array|null $task - данные с информацией о квесте (task массив)
     * @throws InvalidConfigException
     */
    public function __construct(array $task = null, array $config = [])
    {
        /** Если массив с данными о квесте прилетел */
        if (!empty($task)) {

            /** Через try пробуем в атрибут закодировать JSON */
            try {
                /** Сетапим название квеста атрибуту текущей модели */
                $this->quest = $task['name'];

                /** Сетапим имя торговца атрибуту текущей модели */
                $this->trader_name = $task[self::TRADER]['name'];

                /** Сетапим иконку торговца атрибуту текущей модели */
                $this->trader_icon = $task[self::TRADER]['imageLink'];

                /** Сетапим полный JSON с данными атрибуту текущей модели */
                $this->json = Json::encode($task);

                /** Сетапим URL до квестов конкретного торговца */
                $this->url = TradersService::takeApiTasksUrl($task[self::TRADER]['name']);

            } catch (InvalidArgumentException $e) {

                /** Сетапим null для Json - чтобы не прошел валидацию на сохранение */
                $this->json = null;

                /** Логируем что API вернул кривые данные */
                LogService::saveErrorData(Yii::$app->request->getUrl(), ErrorDesc::TYPE_ERROR_JSON_ENCODE_API, ErrorDesc::DESC_ERROR_JSON_ENCODE_API);
            }
        }

        parent::__construct($config);
    }

    /**
     * Вместо имени формы - возвращаем пустую строку
     *
     * @return string
     */
    public function formName(): string
    {
        return '';
    }

    /**
     * Массив правил валидаций данной модели
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            [self::ATTR_QUEST, RequiredValidator::class],
            [self::ATTR_QUEST, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [self::ATTR_TRADER_NAME, RequiredValidator::class],
            [self::ATTR_TRADER_NAME, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [self::ATTR_TRADER_ICON, RequiredValidator::class],
            [self::ATTR_TRADER_ICON, StringValidator::class],

            [self::ATTR_JSON, RequiredValidator::class],
            [self::ATTR_JSON, StringValidator::class],

            [self::ATTR_ACTIVE, IntegerValidator::class],

            [self::ATTR_OLD, IntegerValidator::class],

            [self::ATTR_URL, StringValidator::class]
        ];
    }

    /**
     * Метод для сохранения нового объекта в таблицу API квестов
     *
     * @return bool
     */
    public function save(): bool
    {
        /** Если данные провалидировались текущей моделью */
        if ($this->validate()) {

            /** Создаем новый AR объект модели Tasks */
            $model = new Tasks();

            /** Сетапим все атрибуты текущей модели - атрибутам AR модели */
            $model->quest = $this->quest;
            $model->trader_name = $this->trader_name;
            $model->trader_icon = $this->trader_icon;
            $model->json = $this->json;
            $model->active = $this->active;
            $model->old = $this->old;
            $model->url = $this->url;

            /** Пробуем сохранить данные (Валидация будет при таком подходе) */
            return $model->save();
        }

        /** Возвращаем false - если данные не провалидировались текущей моделью */
        return false;
    }
}