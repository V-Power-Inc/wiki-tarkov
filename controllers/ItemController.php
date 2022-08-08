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
                'duration' => 604800,
                'only' => ['detailloot'],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT MAX(date_update) FROM items',
                ],
                'variations' => [
                    $_SERVER['SERVER_NAME'],
                    Yii::$app->request->url,
                    Yii::$app->response->statusCode
                ]
            ],
        ];
    }
    
    /** Рендер детальной страницы лута */
    public function actionDetailloot($item)
    {

    $loot = Items::find()->where(['url'=>$item])->andWhere(['active' => 1])->One();

    if($loot) {
            return $this->render('/loot/item-detail.php', ['item' => $loot]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /** Рендер страницы предпросмотра детальной страницы лута **/
    public function actionPreviewloot()
    {
        $this->enableCsrfValidation = false;

        if(Yii::$app->user->isGuest !== true) {
            $item = new Items;
            $item->load(Yii::$app->request->post());
            return $this->render('/loot/item-preview.php', ['item' => $item]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

}

