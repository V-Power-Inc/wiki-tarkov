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
use yii\data\Pagination;


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
        $fullitems = Items::find()->where(['active' => 1]);
        $pagination = new Pagination(['defaultPageSize' => 10,'totalCount' => $fullitems->count(),]);
        $items = $fullitems->offset($pagination->offset)->orderby(['id'=>SORT_DESC])->limit($pagination->limit)->all();
        $request = \Yii::$app->request;
        return $this->render('mainpage.php', ['items' => $items, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
    }

    /** Рендер детальной страницы категории - тут рендерятся как родительские так и дочерние категории */
    public function actionCategory($category=null, $child = null)
    {
        $category = Yii::$app->request->get('category');
        $child = Yii::$app->request->get('child');
        $model = Category::find()->where(['enabled' => 1])->andWhere(['url' => $category])->one();
        $childmodel = Category::find()->where(['enabled' => 1])->andWhere(['url' => $child])->one();
        $items = Items::find()->where(['active' => 1])->andWhere(['parentcat_id' => $model['id']]);

        $pagination = new Pagination(['defaultPageSize' => 10,'totalCount' => $items->count(),]);
        $fullitems = $items->offset($pagination->offset)->orderby(['id'=>SORT_DESC])->limit($pagination->limit)->all();
        $request = \Yii::$app->request;
        // Если вернулась основная категория с массивом предметов
        if ($model && $fullitems) {
            return $this->render('categorie-page.php', ['model' => $model, 'items' => $fullitems, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
        } 
        // Если вернулась основная категория с пустым массивом предметов и пустым идентификатором дочерней категории
        elseif ($model && empty($fullitems) && $child == '') {
            $items = Items::find()->where(['active' => 1])->andWhere(['maincat_id' => $model['id']]);
            $pagination = new Pagination(['defaultPageSize' => 10,'totalCount' => $items->count(),]);
            $fullitems = $items->offset($pagination->offset)->orderby(['id'=>SORT_DESC])->limit($pagination->limit)->all();
            $request = \Yii::$app->request;
            return $this->render('categorie-page.php', ['model' => $model, 'items' => $fullitems, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
        } 
        // Если вернулась основная категория и дочерняя категория также была определена
        elseif(($model && !$child == '')) {
            $items = Items::find()->where(['active' => 1])->andWhere(['parentcat_id' => $childmodel['id']]);
            $pagination = new Pagination(['defaultPageSize' => 10,'totalCount' => $items->count(),]);
            $fullitems = $items->offset($pagination->offset)->orderby(['id'=>SORT_DESC])->limit($pagination->limit)->all();
            $request = \Yii::$app->request;
            
            return $this->render('categorie-page.php', ['model' => $model, 'items' => $fullitems, 'childmodel' => $childmodel, 'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination,]);
        } else {
            throw new HttpException(404 ,'Такой категории не существует');
        }
    }

}