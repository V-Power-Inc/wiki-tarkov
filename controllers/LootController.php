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
    public function actionCategory($url)
    {
        $url = Yii::$app->request->get('url');
        $model = Category::find()->where(['enabled' => 1])->andWhere(['url' => $url])->one();
        $items = Items::find()->where(['active' => 1])->andWhere(['parentcat_id' => $model['id']])->all();
        if ($model && $items) {
            return $this->render('categorie-page.php', ['model' => $model, 'items' => $items]);
        } elseif ($model && empty($items)) {
            $items = Items::find()->where(['active' => 1])->andWhere(['maincat_id' => $model['id']])->all();
            return $this->render('categorie-page.php', ['model' => $model, 'items' => $items]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

}