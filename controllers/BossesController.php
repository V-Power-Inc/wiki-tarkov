<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 7:52
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;

/**
 * Class BossesController
 * @package app\controllers
 */
class BossesController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_INDEX = 'index';

    /**
     * Метод выводит список карт и отображает все атрибуты о боссах, которые известны
     */
    public function actionIndex()
    {
        // todo: Реализовать логику вывода страницы со списком боссов
    }
}