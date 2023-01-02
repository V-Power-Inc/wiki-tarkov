<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.08.2022
 * Time: 22:23
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\common\services\MarkersService;
use app\models\Forest;
use app\models\Zavod;
use app\models\Tamojnya;
use app\models\Bereg;
use app\models\Razvyazka;
use app\models\Laboratory;
use Yii;

/**
 * Это контроллер интерактивных карт
 *
 * Class MapsController
 * @package app\controllers
 */
class MapsController extends AdvancedController
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

    /**
     * Массив поведения данного контроллера
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => 3600,
                'variations' => [
                    $_SERVER['SERVER_NAME'],
                    Yii::$app->request->url,
                    Yii::$app->response->statusCode,
                    Yii::$app->request->get('page'),
                    Yii::$app->request->cookies->get('overlay')
                ]
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
     * JSON данные с координатами маркеров Завода
     *
     * @return string
     */
    public function actionZavodmarkers(): string
    {
        return MarkersService::takeMarkers(Zavod::tableName());
    }

    /**
     * JSON данные с координатами маркеров Леса
     *
     * @return string
     */
    public function actionForestmarkers(): string
    {
        return MarkersService::takeMarkers(Forest::tableName());
    }

    /**
     * JSON данные с координатами маркеров Таможни
     *
     * @return string
     */
    public function actionTamojnyamarkers(): string
    {
        return MarkersService::takeMarkers(Tamojnya::tableName());
    }

    /**
     * JSON данные с координатами маркеров Берега
     *
     * @return string
     */
    public function actionBeregmarkers(): string
    {
        return MarkersService::takeMarkers(Bereg::tableName());
    }

    /**
     * JSON данные с координатами маркеров Развязки
     *
     * @return string
     */
    public function actionRazvyazkamarkers(): string
    {
        return MarkersService::takeMarkers(Razvyazka::tableName());
    }

    /**
     * JSON данные с координатами маркеров Лаборатории
     *
     * @return string
     */
    public function actionLaboratorymarkers(): string
    {
        return MarkersService::takeMarkers(Laboratory::tableName());
    }

    /**
     * Рендер страницы с картой завода
     *
     * @return string
     */
    public function actionZavod(): string
    {
        return $this->render('zavod-location');
    }

    /**
     * Рендер страницы с картой Леса
     *
     * @return string
     */
    public function actionForest(): string
    {
        return $this->render('forest-location');
    }

    /**
     * Рендер страницы с картой Таможни
     *
     * @return string
     */
    public function actionTamojnya(): string
    {
        return $this->render('tamojnya-location');
    }

    /**
     * Рендер страницы с картой Берега
     *
     * @return string
     */
    public function actionBereg(): string
    {
        return $this->render('bereg-location');
    }

    /**
     * Рендер страницы с картой Развязки
     *
     * @return string
     */
    public function actionRazvyazka(): string
    {
        return $this->render('razvyazka-location');
    }

    /**
     * Рендер страницы с картой лаборатории TerraGroup
     *
     * @return string
     */
    public function actionLaboratoryterra(): string
    {
        return $this->render('laboratory-location');
    }

    /**
     * Рендер страницы с картой Резерва
     *
     * @return string
     */
    public function actionRezerv(): string
    {
        return $this->render('rezerv');
    }

    /**
     * Рендер страницы с картой Резерва
     *
     * @return string
     */
    public function actionLighthouse(): string
    {
        return $this->render('lighthouse');
    }

    /**
     * Рендер страницы с картой Улицы Таркова
     *
     * @return string
     */
    public function actionStreetsOfTarkov(): string
    {
        return $this->render('streets-of-tarkov');
    }
}