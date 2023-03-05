<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:47
 */

namespace app\common\models\tasks;

/**
 * Класс с набором данных о действующих квестах в игре
 * Используется для создания структурированных объектов данных при вызове API tarkov.dev
 * @link https://api.tarkov.dev
 *
 * Class TasksResult
 * @package app\common\models\tasks
 */
class TasksResult
{
    /** @var TaskItem[] - Массив объектов квестов TaskItem */
    public $_items = [];

    /** @var string - Первый уровень массива с данными из API */
    const FIRST_LEVEL = 'data';

    /** @var string - Второй уровень массива с данными из API */
    const SECOND_LEVEL = 'tasks';


    public function __construct($data)
    {
        /** В цикле проходим каждый квест и создаем структурированный набор данных через объекты */
        foreach ($data[static::FIRST_LEVEL][static::SECOND_LEVEL] as $task) {

            /** Создаем новый объект квеста и закидываем в него данные */
            $model = new TaskItem($task);

            /** Сетапим данные о квесте в результирующий массив квестов */
            $this->_items[] = $model;
        }

        return $this->_items;
    }

}