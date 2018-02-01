<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.01.2018
 * Time: 21:17
 */

namespace app\controllers;
use yii\web\Controller;
use app\models\Items;
use app\models\Category;
use yii\web\HttpException;
use Yii;

class ItemController extends Controller {
    
/** Рендер детальной страницы лута */
public function actionDetailloot($cat,$parentcat=null,$id) {
    

    
    $cat = Yii::$app->request->get('cat');
    $parentcat = Yii::$app->request->get('parentcat');
    $id = Yii::$app->request->get('id');

    $maincategory = Category::find()->where(['enabled' => 1])->andWhere(['url' => $cat])->one();;
    $childcategory = Category::find()->where(['enabled' => 1])->andWhere(['url' => $parentcat])->one();
        
//    echo "<pre>";
//    print_r($cat);
//    echo "<pre>";
//    echo "<hr>";
//    echo "<pre>";
//    print_r($parentcat);
//    echo "<pre>";
//    echo "<hr>";
//    echo "<pre>";
//    print_r($id);
//    echo "<pre>";
//    echo "<hr>";
//    exit();

    if($cat !== '' & $parentcat == '') {
        $item = Items::find()->where(['active' => 1])->andWhere(['url' => $id])->andWhere(['maincat_id' => $maincategory->id])->one();
        return $this->render('/loot/item-detail.php', compact('item'));
    } else if($cat !== '' & $parentcat !== '') {
            $item = Items::find()->where(['active' => 1])->andWhere(['url' => $id])->andWhere(['parentcat_id' => $childcategory->id])->one();
//            echo "<pre>";
//                print_r($item);
//            echo "<pre>";
//            exit();
            return $this->render('/loot/item-detail.php', compact('item'));
        } else {
            throw new HttpException(404 ,'Такого предмета не существует');
        }
    }
}