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
    const ACTION_VIEW  = 'view';

    /** @var string - параметр URL для просмотра детальной вьюхи */
    const PARAM_URL = 'url';

    /**
     * Метод выводит список карт и отображает все атрибуты о боссах, которые известны
     *
     * @return string
     */
    public function actionIndex(): string
    {
        /** Создаем объект класса ApiService */
        $api = new ApiService();

        /** Дергаем метод, который без параметров вернет нам список карт из Bosses */
        $maps = $api->getBosses();

        /** Рендерим вьюху */
        return $this->render('index', ['maps' => $maps]);
    }

    /**
     * Метод рендерит конкретную карту и выводит всю доступную информацию о боссах
     *
     * @param string $url - URL адрес до детальной странице с боссами на конкретной карте
     */
    public function actionView(string $url)
    {
        // todo: Сделать
    }
}