<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 9:17
 */

namespace app\common\interfaces;

use app\models\Bosses;

/**
 * Интерфейс сервиса для работы с API tarkov.dev
 *
 * Interface ApiInterface
 * @package app\common\interfaces
 */
interface ApiInterface
{
    /**
     * Метод должен возращать AR объект класса Bosses для рендеринга
     * в конечном счете во вьюхе для отображения на сайте
     *
     * @param string $map_name - имя локации
     * @return Bosses
     */
    function getBosses(string $map_name): Bosses;
}