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
use yii\web\HttpException;

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
                'duration' => 3600,
                'variations' => [
                    $_SERVER['SERVER_NAME'],
                    Yii::$app->request->url,
                    Yii::$app->request->isAjax,
                    Yii::$app->response->statusCode,
                    Yii::$app->request->get('page'),
                    Yii::$app->request->cookies->get('overlay'),
                    Yii::$app->request->cookies->get('dark_theme')
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
     * @throws HttpException
     * @return string
     */
    public function actionZavodmarkers(): string
    {
        /** Проверяем что запрос идет по Ajax */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем маркеры по названия таблицы в виде JSON */
            return MarkersService::takeMarkers(Zavod::tableName());
        }

        /** Если запрос к странице был не по Ajax - всегда выкидываем 404 ошибку */
        throw new HttpException(404, 'Такая страница не найдена');
    }

    /**
     * JSON данные с координатами маркеров Леса
     *
     * @throws HttpException
     * @return string
     */
    public function actionForestmarkers(): string
    {
        /** Проверяем что запрос идет по Ajax */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем маркеры по названия таблицы в виде JSON */
            return MarkersService::takeMarkers(Forest::tableName());
        }

        /** Если запрос к странице был не по Ajax - всегда выкидываем 404 ошибку */
        throw new HttpException(404, 'Такая страница не найдена');
    }

    /**
     * JSON данные с координатами маркеров Таможни
     *
     * @throws HttpException
     * @return string
     */
    public function actionTamojnyamarkers(): string
    {
        /** Проверяем что запрос идет по Ajax */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем маркеры по названия таблицы в виде JSON */
            return MarkersService::takeMarkers(Tamojnya::tableName());
        }

        /** Если запрос к странице был не по Ajax - всегда выкидываем 404 ошибку */
        throw new HttpException(404, 'Такая страница не найдена');
    }

    /**
     * JSON данные с координатами маркеров Берега
     *
     * @throws HttpException
     * @return string
     */
    public function actionBeregmarkers(): string
    {
        /** Проверяем что запрос идет по Ajax */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем маркеры по названия таблицы в виде JSON */
            return MarkersService::takeMarkers(Bereg::tableName());
        }

        /** Если запрос к странице был не по Ajax - всегда выкидываем 404 ошибку */
        throw new HttpException(404, 'Такая страница не найдена');
    }

    /**
     * JSON данные с координатами маркеров Развязки
     *
     * @throws HttpException
     * @return string
     */
    public function actionRazvyazkamarkers(): string
    {
        /** Проверяем что запрос идет по Ajax */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем маркеры по названия таблицы в виде JSON */
            return MarkersService::takeMarkers(Razvyazka::tableName());
        }

        /** Если запрос к странице был не по Ajax - всегда выкидываем 404 ошибку */
        throw new HttpException(404, 'Такая страница не найдена');
    }

    /**
     * JSON данные с координатами маркеров Лаборатории
     *
     * @throws HttpException
     * @return string
     */
    public function actionLaboratorymarkers(): string
    {
        /** Проверяем что запрос идет по Ajax */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем маркеры по названия таблицы в виде JSON */
            return MarkersService::takeMarkers(Laboratory::tableName());
        }

        /** Если запрос к странице был не по Ajax - всегда выкидываем 404 ошибку */
        throw new HttpException(404, 'Такая страница не найдена');
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