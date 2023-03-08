<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:18
 */

namespace app\common\models\tasks;

/**
 * Класс с атрибутами сущности - квесты, которые должны быть завершены, чтобы взять задание
 *
 * Class TaskRequirementsItem
 * @package app\common\models\tasks
 */
final class TaskRequirementsItem
{
    /** @var array - название квеста (Далее name в массиве) */
    public $task;

    /** @var array - Статусы, которые могут быть у текущей задачи (В массиве список статусов) */
    public $status;

    /** @var TaskRequirementsItem[] - Массив объектов с выполненными заданиями */
    public $_items = [];

    /** @var string - Ключ массива с информацией о названии квеста */
    const TASK = 'task';

    /** @var string - Ключ массива с информацией о необходимом статусе задания */
    const STATUS = 'status';

    /**
     * В конструкторе наполняем массив данных о задачах необходимых для взятия квеста, если массив прилетел в этот класс
     * если массив в класс не прилетал, конструктор ничего делать не будет
     *
     * TaskRequirementsItem constructor.
     * @param array $tasks
     */
    public function __construct(array $tasks = null)
    {
        /** Если массив с данными о задачах - не пуст */
        if (!empty($tasks)) {

            /** В цикле проходим все условия задач */
            foreach ($tasks as $obj) {

                /** Создаем новый объект класса о задачах */
                $model = new TaskRequirementsItem();

                /** Сетапим название задачи */
                $model->task = $obj[static::TASK]['name'];

                /** Сетапим массив статусов задачи */
                $model->status = $obj[static::STATUS];

                /** Добавляем новый объект, в модель с результирующей выборкой */
                $this->_items[] = $model;
            }

            return $this->_items;
        }
    }
}