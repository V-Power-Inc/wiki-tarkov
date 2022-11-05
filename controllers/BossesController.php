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
use app\common\services\ArrayService;
use app\models\Bosses;
use yii\web\HttpException;

/**
 * Class BossesController
 * @package app\controllers
 */
class BossesController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_INDEX = 'index';
    const ACTION_VIEW  = 'view';

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
     * @return mixed
     */
    public function actionView(string $url)
    {
        /** Создаем объект класса ApiService */
        $api = new ApiService();

        /** Проверяем есть ли в БД страница с таким URL адресом */
        if($url && Bosses::isExists($url) == true) {

            /** Дергаем метод, который вернет нам детальную страницу Боссов */
            $bosses = $api->getBosses($url);

            /** Рендерим вьюху */
            return $this->render('view', [
                'bosses' => $bosses,
                'map_title' => Bosses::findMapTitleByUrl($url)
            ]);
        }

        /** Проверяем в статичном массиве, был ли такой Url адрес раньше */
        if(in_array($url, ArrayService::existingMapNames())) {

            /** Дергаем метод по обновлению боссов */
            $api->getBosses($url);

            /** Редиректим на главную страницу боссов */
            return $this->redirect(BossesController::getUrlRoute(BossesController::ACTION_INDEX));
        }

        /** Exception на всякий случай */
        throw new HttpException(404, 'Такая страница не существует');
    }
}