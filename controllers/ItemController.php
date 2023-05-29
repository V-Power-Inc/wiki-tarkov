<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.01.2018
 * Time: 21:17
 */

namespace app\controllers;
use app\common\controllers\AdvancedController;
use yii\web\HttpException;
use app\models\Items;
use Yii;

/**
 * Class ItemController
 * @package app\controllers
 */
class ItemController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_DETAILLOOT = 'detailloot';
    const ACTION_PREVIEWLOOT = 'previewloot';

    /** CSRF валидация POST запросов методов этого контроллера включена */
    public $enableCsrfValidation;

    /**
     * Кешируем все запросы из БД - храним их в кеше (Массив поведения контроллера)
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheTime']['seven_days'],
                'only' => ['detailloot'],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT MAX(date_update) FROM items',
                ],
                'variations' => [
                    $_SERVER['SERVER_NAME'],
                    Yii::$app->request->url,
                    Yii::$app->response->statusCode,
                    Yii::$app->request->cookies->get('overlay'),
                    Yii::$app->request->cookies->get('sticky'),
                    Yii::$app->request->cookies->get('dark_theme')
                ]
            ],
        ];
    }

    /**
     * Рендер детальной страницы лута
     *
     * @param $item - url адрес
     * @return string
     * @throws HttpException
     */
    public function actionDetailloot($item): string
    {
        if (Items::takeActiveItemByUrl($item)) {
            return $this->render('/loot/item-detail.php', ['item' => Items::takeActiveItemByUrl($item)]);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

    /**
     * Рендер страницы предпросмотра детальной страницы лута
     *
     * @return string
     * @throws HttpException
     */
    public function actionPreviewloot(): string
    {
        $this->enableCsrfValidation = false;

        if(Yii::$app->user->isGuest !== true) {
            $item = new Items();
            $item->load(Yii::$app->request->post());
            return $this->render('/loot/item-preview.php', ['item' => $item]);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

}

