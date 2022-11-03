<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 7:52
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\common\services\ApiService;

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
        $api = new ApiService();


        $bosses = $api->getBosses();


        echo '<pre>';
        echo print_r($bosses);
        exit;
        echo '</pre>';

    }
}