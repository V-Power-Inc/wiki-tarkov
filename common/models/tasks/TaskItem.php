<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:02
 */

namespace app\common\models\tasks;

/**
 * Класс с атрибутами сущности - квест
 *
 * Class TaskItem
 * @package app\common\models\tasks
 */
class TaskItem
{
    /** @var int - ID квеста из таблицы tasks */
    public $id;

    /** @var string - Имя квеста */
    public $name;

    /** @var string - Для какой фракции квест (Bear или Usec) */
    public $factionName;

    /** @var int - Минимальный уровень персонажа для взятия квеста */
    public $minPlayerLevel;

    /** @var int - Количество опыта, которое дадут за выполнение задания */
    public $experience;

    /** @var bool - Является ли квест возобновляемым (Доступен для многократного прохождения) */
    public $restartable;

    /** @var TraderItem - Объект с данными о торговце, который выдает квест */
    public $trader;

    /** @var MapItem[] - Массив с локациями, к которым имеет отношение квест */
    public $map;

    /** @var ObjectivesItem[] - Массив с условиями для выполнения задачи */
    public $objectives;

    /** @var KeysItem[] - Массив с требуемыми ключами для прохождения квеста */
    public $neededKeys;

    /** @var TaskRequirementsItem[] - Массив с квестами, которые должны быть завершены для взятия текущего задания */
    public $taskRequirements;

    /** @var RewardsItem[] - Массив с предметами, необходимыми для начала работы с квестом */
    public $startRewards;

    /** @var RewardsItem[] - Массив с предметами, которые получаешь за выполнение квеста */
    public $finishRewards;

    /** @var string - Ключ массива с информацией о торговце */
    const TRADER = 'trader';

    /** @var string - Ключ массива с информацией о карте */
    const MAP = 'map';

    /** @var string - Ключ массива с информацией о целях задачи */
    const OBJECTIVES = 'objectives';

    /** @var string - Ключ массива с информацией о ключах */
    const KEYS = 'neededKeys';

    /** @var string - Ключ массива с информацией о необходимых выполненных заданиях */
    const TASK_REQUIREMENTS = 'taskRequirements';

    /** @var string - Ключ массива с информацией о стартовых вещах, необходимых для выполнения квеста */
    const START_REWARDS = 'startRewards';

    /** @var string - Ключ массива с информацией о вещах, которые дадут в награду, за выполнение квеста */
    const FINISH_REWARDS = 'finishRewards';

    /** @var string - Ключ массива до предметов, выдаваемых за выполнение квеста или необходимых для его завершения */
    const ITEMS = 'items';

    /**
     * Сетапим данные о квесте атрибутам текущей модели через конструктор
     *
     * TaskItem constructor.
     * @param array $data - данные (JSON со всеми данными о конкретном квесте)
     * @param int $id - id квеста из таблицы tasks
     */
    public function __construct(array $data, int $id)
    {
        /** Задаем id квеста */
        $this->id = $id;

        /** Задаем имя квеста */
        $this->name = $data['name'];

        /** Задаем фракцию квеста */
        $this->factionName = $data['factionName'];

        /** Задаем минимальный уровень персонажа */
        $this->minPlayerLevel = $data['minPlayerLevel'];

        /** Задаем количество опыта, получаемое за выполнение квеста */
        $this->experience = $data['experience'];

        /** Указываем, является ли квест рестартуемым */
        $this->restartable = $data['restartable'];

        /** Сетапим торговцу атрибуты соответствующего массива по ключу */
        $this->trader = new TraderItem($data[static::TRADER]);

        /** Сетапим локации атрибуты соответствующего массива по ключу */
        $this->map = new MapItem($data[static::MAP]);

        /** Сетапим условия квеста атрибуты соответствующего массива по ключу */
        $this->objectives = new ObjectivesItem($data[static::OBJECTIVES]);

        /** Сетапим необходимые ключи - атрибуты соответствующего массива по ключу */
        $this->neededKeys = new KeysItem($data[static::KEYS]);

        /** Сетапим необходимые выполненные квесты - атрибуты соответствующего массива по ключу */
        $this->taskRequirements = new TaskRequirementsItem($data[static::TASK_REQUIREMENTS]);

        /** Сетапим необходимые для выполнения квеста предметы - атрибуты соответствующего массива по ключу */
        $this->startRewards = new StartRewardsResult($data[static::START_REWARDS][static::ITEMS]);

        /** Сетапим предметы, которые получим за выполнение квеста - атрибуты соответствующего массива по ключу */
        $this->finishRewards = new FinishRewardsResult($data[static::FINISH_REWARDS][static::ITEMS]);
    }

}