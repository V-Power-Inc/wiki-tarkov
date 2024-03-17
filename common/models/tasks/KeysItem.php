<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:15
 */

namespace app\common\models\tasks;

/**
 * Класс с атрибутами сущности - требуемые ключи
 *
 * Class KeysItem
 * @package app\common\models\tasks
 */
final class KeysItem
{
    /** @var string - Имя ключа */
    public $name;

    /** @var string - Иконка ключа */
    public $iconLink;

    /** @var KeysItem[] - Массив объектов с ключами от помещений */
    public $_items;

    /** @var string - Ключ массива с информацией о ключе */
    private const KEYS = 'keys';

    /**
     * В конструкторе собираем массив объектов с информацией о ключах если сюда прилетел массив
     * в ином случае ничего не делаем при инициализации этого класса
     *
     * KeysItem constructor.
     * @param array $keys
     */
    public function __construct(array $keys = null)
    {
        /** Если массив с ключами - не пустой */
        if (!empty($keys)) {

            /** В цикле опускаемся на уровень ниже */
            foreach ($keys as $obj) {

                /** В цикле получаем информацию по ключу */
                foreach ($obj[self::KEYS] as $item_key) {

                    /** Создаем новый объект с информацией о ключе */
                    $model = new KeysItem();

                    /** Сетапим название ключа */
                    $model->name = $item_key['name'];

                    /** Сетапим иконку ключа */
                    $model->iconLink = $item_key['iconLink'];

                    /** Добавляем объект с информацией о ключе в результирующий массив */
                    $this->_items[] = $model;
                }
            }

            /** Возвращаем массив объектов с информацией о ключах */
            return $this->_items;
        }
    }
}