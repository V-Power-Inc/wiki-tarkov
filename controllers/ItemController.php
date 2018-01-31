<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.01.2018
 * Time: 21:17
 */

namespace app\controllers;
use app\models\Category;
use yii\web\Controller;
use app\models\Items;
use yii\web\HttpException;
use Yii;

class ItemController extends Controller {
    
/** Рендер детальной страницы лута */
public function actionDetailloot($id) {
    $id = Yii::$app->request->get('id');
    $item = Items::findOne($id);
    
        if($item) {
            return $this->render('/loot/item-detail.php', compact('item'));
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
}