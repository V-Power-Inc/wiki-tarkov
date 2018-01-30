<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 25.01.2018
 * Time: 19:17
 */
/** Этот контроллер отвечает за вывод категорий и лута предметов из Escape from Tarkov  **/
namespace app\controllers;

use yii\web\Controller;
use yii;
use app\models\Category;
use app\models\Items;
use yii\web\HttpException;


class LootController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */

    /** Рендер страницы списка категорий и общего списка лута  **/
    public function actionMainloot()
    {
        return $this->render('mainpage.php');
    }

    /** Рендер детальной страницы категории - тут рендерятся как родительские так и дочерние категории */
    public function actionCategory($id)
    {
        $Categories = Category::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->One();
        $Items = Items::find()->where(['active' => 1])->andWhere(['parentcat_id' => $Categories->id])->asArray()->all();
        if($Categories) {
//            echo "<pre>";
//                print_r($Items);
//            echo "<pre>";
//            echo '<hr>';
//            echo "<pre>";
//            print_r($Categories);
//            echo "<pre>";
//            exit();
            return $this->render('categorie-page.php',['model' => $Categories]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    /** Рендер детальной страницы лута */
    public function actionDetailloot() {
        return $this->render('item-detail.php');
    }
    
    
    
    
    
}