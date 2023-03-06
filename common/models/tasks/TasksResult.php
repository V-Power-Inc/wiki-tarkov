<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:47
 */

namespace app\common\models\tasks;

use yii\helpers\Json;

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

    /** @var string - Ключ поля до Json объекта */
    const JSON = 'json';

    /**
     * Конструктор для возвращения структурированного массива объектов о квестах
     *
     * TasksResult constructor.
     * @param array $data - полный массив данных обо всех квестах из API (Active Record массив)
     */
    public function __construct(array $data)
    {
        /** В цикле проходим каждый квест и создаем структурированный набор данных через объекты */
        foreach ($data as $task) {

            /** Создаем новый объект квеста и закидываем в него данные (Предварительно декодировав из Json) а также id квеста из БД */
            $model = new TaskItem(Json::decode($task[static::JSON]), $task->id);

            /** Сетапим данные о квесте в результирующий массив квестов */
            $this->_items[] = $model;
        }

        /** Возвращаем массив объектов с квестами */
        return $this->_items;
    }
}