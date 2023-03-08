<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:10
 */

namespace app\common\models\tasks;

/**
 * Класс с атрибутами сущности - цели квеста
 *
 * Class ObjectivesItem
 * @package app\common\models\tasks
 */
final class ObjectivesItem
{
    /** @var string - Тип задания (Убийство, сбор вещей, закладки и т.д.) */
    public $type;

    /** @var string - Описание задачи */
    public $description;

    /** @var bool - Является ли условие задачи опциональным */
    public $optional;

    /** @var ObjectivesItem[] - Массив объектов необходимых для выполнения задачи */
    public $_items = [];

    /**
     * В конструкторе - сетапим атрибуты требований задачи, если массив сюда прилетел
     * тогда вернем массив объектов с целями задачи - в ином случае ничего не произойдет
     *
     * ObjectivesItem constructor.
     * @param array $objectives
     * @return mixed
     */
    public function __construct(array $objectives = null)
    {
        /** Если массив с целями задачи не пуст */
        if (!empty($objectives)) {

            /** В цикле проходим каждую задачу и создаем для нее новый объект */
            foreach ($objectives as $objective) {

                /** Создаем новый объект - цель задачи */
                $model = new ObjectivesItem();

                /** Сетапим тип задачи */
                $model->type = $objective['type'];

                /** Сетапим описание задачи */
                $model->description = $objective['description'];

                /** Сетапим - является ли условие задачи обязательным */
                $model->optional = $objective['optional'];

                /** Добавдяем новый объект в массив объектов задач */
                $this->_items[] = $model;
            }

            /** Возращаем массив объектов задачи */
            return $this->_items;
        }
    }
}