<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.01.2018
 * Time: 21:17
 */

namespace app\controllers;
use yii\web\Controller;
use yii\web\HttpException;
use app\models\Items;
use Yii;

class ItemController extends Controller {
    
    // CSRF валидация POST запросов методов этого контроллера отключена
    public $enableCsrfValidation = false;

    // Кешируем все запросы из БД - храним их в кеше
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => 604800,
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM items where active = 1',
                ],
                'variations' => [
                    Yii::$app->request->url
                ]
            ],
        ];
    }
    
/** Рендер детальной страницы лута */
public function actionDetailloot($item) {

    $loot = Items::find()->where(['url'=>$item])->andWhere(['active' => 1])->One();
       
    if($loot) {
            return $this->render('/loot/item-detail.php', ['item' => $loot]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /** Рендер страницы предпросмотра детальной страницы лута **/
    public function actionPreviewloot() {
        if(Yii::$app->user->isGuest !== true) {
            $item = new Items;
            $item->load(Yii::$app->request->post());
            return $this->render('/loot/item-preview.php', ['item' => $item]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
}

