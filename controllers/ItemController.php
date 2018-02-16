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
    
/** Рендер детальной страницы лута */
public function actionDetailloot($item) {

        if($item) {
        $loot = Items::find()->where(['url'=>$item])->andWhere(['active' => 1])->One();
            return $this->render('/loot/item-detail.php', ['item' => $loot]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
}


