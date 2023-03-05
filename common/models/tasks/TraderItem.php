<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:29
 */

namespace app\common\models\tasks;

/**
 * Класс с атрибутами сущности - торговец, что выдает квест
 *
 * Class TraderItem
 * @package app\common\models\tasks
 */
class TraderItem
{
    /** @var string - Имя торговца */
    public $name;

    /** @var string - Изображение торговца */
    public $imageLink;

    /**
     * Сетапим данные о торговце через конструктор
     *
     * TraderItem constructor.
     * @param array $trader
     */
    public function __construct(array $trader = null)
    {
        /** Если массив с данными о торговце не пустой */
        if (!empty($trader)) {

            /** Сетапим имя торговца */
            $this->name = $trader['name'];

            /** Сетапим изображение торговца */
            $this->imageLink = $trader['imageLink'];
        }

        /** Возвращаем массив объектов торговцев - текущей модели */
        return $this;
    }
}