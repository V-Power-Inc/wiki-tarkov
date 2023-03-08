<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:26
 */

namespace app\common\models\tasks;

/**
 * Класс с атрибутами сущности - локация выполнения квеста
 *
 * Class MapItem
 * @package app\common\models\tasks
 */
final class MapItem
{
    /** @var string - Название карты */
    public $name;

    /**
     * Сетапим через конструктор атрибуты текущей модели
     *
     * MapItem constructor.
     * @param array $map
     */
    public function __construct(array $map = null)
    {
        /** Если массив с данными о картах не пуст */
        if (!empty($map)) {

            /** Сетапим название карты */
            $this->name = $map['name'];
        }

        /** Возвращаем результат - объект текущей модели */
        return $this;
    }
}