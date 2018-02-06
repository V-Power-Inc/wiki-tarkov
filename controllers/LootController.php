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
use yii\data\Pagination;
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
    public function actionCategory($name)
    {
       
        $cat = Category::find()->where(['url'=>$name])->One();
        
        if($cat) {
            // Тут надо получить предметы из всех дочерних категорий если мы находимся в родительской
            $fullitems = Items::find()->where(['parentcat_id' => $cat['id']])->andWhere(['active' => 1]);
            $pagination = new Pagination(['defaultPageSize' => 1,'totalCount' => $fullitems->count(),]);
            $items = $fullitems->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->all();
            $request = \Yii::$app->request;
            return $this->render('categorie-page.php', ['cat' => $cat, 'items' => $items, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
       
    }

}