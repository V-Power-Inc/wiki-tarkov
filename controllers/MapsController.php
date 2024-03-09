<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.08.2022
 * Time: 22:23
 */

namespace app\controllers;

use app\common\interfaces\ResponseStatusInterface;
use app\common\controllers\AdvancedController;
use app\common\services\MarkersService;
use app\common\services\redis\RedisVariationsConfig;
use Yii;
use yii\web\HttpException;

/**
 * Это контроллер интерактивных карт
 *
 * Class MapsController
 * @package app\controllers
 */
final class MapsController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_LOCATIONS         = 'locations';
    const ACTION_ZAVODMARKERS      = 'zavodmarkers';
    const ACTION_FORESTMARKERS     = 'forestmarkers';
    const ACTION_TAMOJNYAMARKERS   = 'tamojnyamarkers';
    const ACTION_BEREGMARKERS      = 'beregmarkers';
    const ACTION_RAZVYAZKAMARKERS  = 'razvyazkamarkers';
    const ACTION_LABORATORYMARKERS = 'laboratorymarkers';
    const ACTION_ZAVOD             = 'zavod';
    const ACTION_FOREST            = 'forest';
    const ACTION_TAMOJNYA          = 'tamojnya';
    const ACTION_BEREG             = 'bereg';
    const ACTION_RAZVYAZKA         = 'razvyazka';
    const ACTION_LABORATORYTERRA   = 'laboratoryterra';
    const ACTION_REZERV            = 'rezerv';
    const ACTION_LIGHTHOUSE        = 'lighthouse';
    const ACTION_STREETS_OF_TARKOV = 'streets-of-tarkov';
    const ACTION_EPICENTER = 'epicenter';

    /** @var string - GET параметр локации */
    const PARAM_MAP = 'map';

    /**
     * Массив поведения данного контроллера
     * В variations указаны вариации страниц, у которых будет раздельный кэш - например:
     * - URL реквеста
     * - AJAX или нет
     * - Код ответа страницы
     * - Наличие параметра GET page
     * - Наличие куки Overlay для рекламы
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheTime']['seven_days'],
                'variations' => RedisVariationsConfig::getMapsControllerVariations()
            ],
        ];
    }

    /**
     * Рендер страницы со списком интерактивных карт
     *
     * @return string
     */
    public function actionLocations(): string
    {
        return $this->render('maps');
    }

    /**
     * Метод возвращает маркеры локаций по GET параметру название карты
     *
     * @return string
     */
    public function actionGetMarkers(): string
    {
        /** Проверяем что запрос идет по Ajax */
        if (Yii::$app->request->isAjax) {

            /** Массив GET параметров */
            $params = Yii::$app->request->get();

            /** Если не пуст параметр с названием локации */
            if (!empty($params[static::PARAM_MAP])) {

                /** Возвращаем маркеры по названия таблицы в виде JSON */
                return MarkersService::takeMarkers($params[static::PARAM_MAP]);
            }
        }

        /** Если запрос к странице был не по Ajax - всегда выкидываем 404 ошибку */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE, 'Такая страница не найдена');
    }

    /**
     * Рендер страницы с картой завода
     *
     * @return string
     */
    public function actionZavod(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('zavod-location');
    }

    /**
     * Рендер страницы с картой Леса
     *
     * @return string
     */
    public function actionForest(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('forest-location');
    }

    /**
     * Рендер страницы с картой Таможни
     *
     * @return string
     */
    public function actionTamojnya(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('tamojnya-location');
    }

    /**
     * Рендер страницы с картой Берега
     *
     * @return string
     */
    public function actionBereg(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('bereg-location');
    }

    /**
     * Рендер страницы с картой Развязки
     *
     * @return string
     */
    public function actionRazvyazka(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('razvyazka-location');
    }

    /**
     * Рендер страницы с картой лаборатории TerraGroup
     *
     * @return string
     */
    public function actionLaboratoryterra(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('laboratory-location');
    }

    /**
     * Рендер страницы с картой Резерва
     *
     * @return string
     */
    public function actionRezerv(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('rezerv');
    }

    /**
     * Рендер страницы с картой Резерва
     *
     * @return string
     */
    public function actionLighthouse(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('lighthouse');
    }

    /**
     * Рендер страницы с картой Улицы Таркова
     *
     * @return string
     */
    public function actionStreetsOfTarkov(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('streets-of-tarkov');
    }

    /**
     * Рендер страницы с картой Эпицентр
     *
     * @return string
     */
    public function actionEpicenter(): string
    {
        /** Рендерим вьюху с картой */
        return $this->render('epicenter');
    }
}