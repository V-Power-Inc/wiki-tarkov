<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:42
 */

namespace app\common\models\tasks;

/**
 * Class FinishRewardsResult
 * @package app\common\models\tasks
 */
final class FinishRewardsResult
{
    /** @var RewardsItem[] - Массив с предметами для выдачи */
    public array $_items = [];

    /** @var string - Ключ массива до данных с предметов */
    private const ITEM = 'item';

    /** @var string - Ключ массива до данных с количество предметов */
    private const COUNT = 'count';

    /**
     * В конструкторе сетапим данные о предметах, которые получим за выполнение задания если массив прилетел
     * если же массива не было, конструктор ничего делать не будет
     *
     * StartRewardsResult constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        /** Если прилетел массив с данными о предметах, которые получим за выполнение задания */
        if (!empty($items)) {

            /** Проходим их в цикле и создаем соответствующие наборы данных */
            foreach ($items as $item) {

                /** Создаем новый объект предмета */
                $model = new RewardsItem();

                /** Сетапим название предмета */
                $model->name = $item[self::ITEM]['name'];

                /** Сетапим описание предмета */
                $model->description = $item[self::ITEM]['description'];

                /** Сетапим иконку предмета */
                $model->iconLink = $item[self::ITEM]['iconLink'];

                /** Сетапим инспектирующее изображение предмета */
                $model->inspectImageLink = $item[self::ITEM]['inspectImageLink'];

                /** Сетапим необходимое количество предметов */
                $model->count = $item[self::COUNT];

                /** Добавляем новый объект с данными в массив объектов для результирующей выборки */
                $this->_items[] = $model;
            }

            /** Возвращаем массив объектов с предметами, которые получим за выполнение задания */
            return $this->_items;
        }
    }
}