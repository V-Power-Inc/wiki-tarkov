<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2023
 * Time: 15:35
 */

namespace app\common\models\tasks;

/**
 * Класс с атрибутами сущности - предмет, выдаваемый за завершение квеста, либо необходимый для начала выполнения квеста
 *
 * Class StartRewardsItem
 * @package app\common\models\tasks
 */
final class RewardsItem
{
    /** @var string - Название предмета */
    public $name;

    /** @var string - Описание предмета */
    public $description;

    /** @var string - Маленькая иконка предмета */
    public $iconLink;

    /** @var string - Изображение детального просмотра */
    public $inspectImageLink;

    /** @var int - Количество предмета */
    public $count;
}