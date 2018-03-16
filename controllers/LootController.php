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
use app\models\Doorkeys;
use yii\data\Pagination;
use yii\web\HttpException;
use yii\helpers\Json;
use yii\db\Query;


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
        $model = new Items;
        $allitems = $model->getActiveItems();
        $fullitems = Items::find()->where(['active' => 1]);
        $pagination = new Pagination(['defaultPageSize' => 50,'totalCount' => $fullitems->count(),]);
        $items = $fullitems->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->all();
        $request = \Yii::$app->request;

        return $this->render('mainpage.php', ['model' => $model, 'items' => $items, 'allitems' => $allitems,'active_page' => $request->get('page',1),'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination]);
    }

    /** Рендер детальной страницы категории - тут рендерятся как родительские так и дочерние категории */
    public function actionCategory($name)
    {
        $cat = Category::find()->where(['url'=>$name])->One();
        if($cat) {
            $fullitems = Items::find()
                ->alias( 'i')
                ->select('i.*')
                ->leftJoin('category as c1', '`i`.`parentcat_id` = `c1`.`id`')
                ->andWhere(['c1.url' => $name])
                ->andWhere(['active' => 1])
                ->orWhere(['c1.parent_category' => $cat->id])
                ->andWhere(['active' => 1])
                ->with('parentcat');

            $pagination = new Pagination(['defaultPageSize' => 50,'totalCount' => $fullitems->count(),]);
            $items = $fullitems->offset($pagination->offset)->orderby(['date_create'=>SORT_DESC])->limit($pagination->limit)->all();
            $request = \Yii::$app->request;

            return $this->render('categorie-page.php', ['cat' => $cat, 'items' => $items, 'active_page' => $request->get('page',1), 'count_pages' => $pagination->getPageCount(), 'pagination' => $pagination]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }

    }

    /*** Рендер страницы списка предметов для квестов торговцев ***/
    public function actionQuestloot()
    {
        $allquestitems = Items::find()->where(['quest_item' => 1])->all();

        $form_model = new Items();
        if ($form_model->load(Yii::$app->request->post())) {
            if (isset($_POST['Items']['questitem'])) {
                $questitem = $_POST['Items']['questitem'];
            } else {
                $questitem = "Все предметы";
            }


            $words = ["Все предметы","Прапор","Терапевт","Скупщик","Лыжник","Миротворец","Механик"];

            /** Если пришли данные через POST **/
            if(in_array($questitem,$words)) {
                $curentWord = $words[array_search($questitem, $words)];
                if ($curentWord == "Все предметы") {
                    $result = Items::find()->where(['active' => 1])->andWhere(['quest_item' => 1])->orderby(['title' => SORT_STRING])->all();
                } else {
                    $result = Items::find()->andWhere(['active' => 1])->andWhere(['quest_item' => 1])->andWhere(['like', 'trader_group', [$curentWord]])->orderby(['title' => SORT_STRING])->all();
                }

                return $this->render('quest-page.php',
                    [
                        'form_model' => $form_model,
                        'questsearch' => $result,
                        'arr' => $curentWord,]);
            }
        }  else {
            return $this->render('quest-page.php',
                [
                    'allquestitems' => $allquestitems,
                    'form_model' => $form_model]);
        }
    }

    /** Экшон возвращает в Json формате данные, совпадающие с набором в поиске на страницах справочника лута. **/
    /** Запрос к базе происходит всякий раз когда пользователь печатает новый или удаляет старый символ в поле поиска предметов **/

    public function actionLootjson($q = null) {

        $query = new Query;

        $query->select('title, shortdesc, preview, url, parentcat_id, search_words')
            ->from('items')
            ->where('title LIKE "%' . $q .'%"')
            ->orWhere('search_words LIKE "%' .$q.'%"')
            ->andWhere(['active' => 1])
            ->orderBy('title');
        $command = $query->createCommand();
        $data = $command->queryAll();

        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {
            $parencat = Category::find()->where(['id' => $d['parentcat_id']])->one();
            $out[] = ['value' => $d['title'],'title' => $d['title'],'parentcat_id' => $parencat->title,'shortdesc' => $d['shortdesc'],'preview' => $d['preview'],'url' => $d['url']];
        }
        return Json::encode($out);
    }
}