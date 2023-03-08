<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:32
 */

namespace app\common\models\tasks;

/**
 * Класс с массивом предметов, которые нужны для выполнения квеста
 *
 * Class StartRewardsResult
 * @package app\common\models\tasks
 */
final class StartRewardsResult
{
    /** @var RewardsItem[] - Массив с предметами для вы */
    public $_items;

    /** @var string - Ключ массива до данных с предметов */
    const ITEM = 'item';

    /** @var string - Ключ массива до данных с количество предметов */
    const COUNT = 'count';

    /**
     * В конструкторе сетапим данные о предметах, необходимых для выполнения задания, если массив прилетел
     * если же массива не было, конструктор ничего делать не будет
     *
     * StartRewardsResult constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        /** Если прилетел массив с данными о предметах, необходимых для выполнения задания */
        if (!empty($items)) {

            /** Проходим их в цикле и создаем соответствующие наборы данных */
            foreach ($items as $item) {

                /** Создаем новый объект предмета */
                $model = new RewardsItem();

                /** Сетапим название предмета */
                $model->name = $item[static::ITEM]['name'];

                /** Сетапим описание предмета */
                $model->description = $item[static::ITEM]['description'];

                /** Сетапим иконку предмета */
                $model->iconLink = $item[static::ITEM]['iconLink'];

                /** Сетапим инспектирующее изображение предмета */
                $model->inspectImageLink = $item[static::ITEM]['inspectImageLink'];

                /** Сетапим необходимое количество предметов */
                $model->count = $item[static::COUNT];

                /** Добавляем новый объект с данными в массив объектов для результирующей выборки */
                $this->_items[] = $model;
            }

            /** Возвращаем массив объектов с предметами, необходимыми для выполнения задания */
            return $this->_items;
        }
    }
}