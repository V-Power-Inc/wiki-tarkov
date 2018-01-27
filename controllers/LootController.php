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
        $models = Category::find()->where(['url'=>$id])->andWhere(['enabled' => 1])->One();
        if($models) {
            return $this->render('categorie-page.php',['model' => $models]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
    
    
    
    
}