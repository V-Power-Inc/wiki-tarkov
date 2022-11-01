<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 25.01.2018
 * Time: 19:17
 */
/** Этот контроллер отвечает за вывод категорий и лута предметов из Escape from Tarkov  **/
namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\common\services\JsondataService;
use yii;
use app\models\Category;
use app\models\Items;
use app\models\Traders;
use yii\web\HttpException;
use app\common\services\PaginationService;
use app\common\services\TraderService;

/**
 * Class LootController
 * @package app\controllers
 */
class LootController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_MAINLOOT  = 'mainloot';
    const ACTION_CATEGORY  = 'category';
    const ACTION_QUESTLOOT = 'questloot';
    const ACTION_LOOTJSON  = 'lootjson';

    /**
     * Массив поведения контроллера
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => 604800,
                'only' => ['mainloot','category'],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT MAX(date_update) FROM items',
                ],
                'variations' => [
                    $_SERVER['SERVER_NAME'],
                    Yii::$app->request->url,
                    Yii::$app->response->statusCode,
                    Yii::$app->request->get('page'),
                    Yii::$app->request->cookies->get('overlay')
                ]
            ],
        ];
    }

    /**
     * Рендер страницы списка категорий и общего списка лута
     *
     * @return string
     */
    public function actionMainloot(): string
    {
        $model = new Items();
        $fullitems = Items::find()->where(['active' => 1]);
        $data = new PaginationService($fullitems,50);

        return $this->render('mainpage.php', [
            'model' => $model,
            'items' => $data->items,
            'allitems' => $model->getActiveItems(),
            'active_page' => Yii::$app->request->get('page',1),
            'count_pages' => $data->paginator->getPageCount(),
            'pagination' => $data->paginator
        ]);
    }

    /**
     * Рендер детальной страницы категории - тут рендерятся как родительские так и дочерние категории
     *
     * @param string $name - url адрес
     * @return string
     * @throws HttpException
     */
    public function actionCategory(string $name): string
    {
        $cat = Category::find()->where(['url'=>$name])->One();
        if ($cat) {
            $data = new PaginationService(Items::takeItemsWithParentCat($name, $cat->id));
            return $this->render('categorie-page.php', [
                'cat' => $cat,
                'items' => $data->items,
                'active_page' => Yii::$app->request->get('page',1),
                'count_pages' => $data->paginator->getPageCount(),
                'pagination' => $data->paginator
            ]);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

    /**
     * Рендер страницы списка предметов для квестов торговцев
     *
     * @return string
     */
    public function actionQuestloot(): string
    {
        $form_model = new Items();

        if ($form_model->load(Yii::$app->request->post())) {

            return $this->render('quest-page', [
                'form_model' => $form_model,
                'questsearch' => TraderService::takeResult($form_model),
                'formValue' => (string)Traders::traderGroups()[$form_model->questitem]
            ]);
        }

        return $this->render('quest-page', [
                'allquestitems' => Items::takeActiveQuestItems(),
                'form_model' => $form_model
        ]);
    }

    /**
     * Экшон возвращает в Json формате данные, совпадающие с набором в поиске на страницах справочника лута.
     * Запрос к базе происходит всякий раз когда пользователь печатает новый или удаляет
     * старый символ в поле поиска предметов
     *
     * @param string|null $q - поисковый запрос
     * @return string
     * @throws HttpException
     * @throws yii\db\Exception
     */
    public function actionLootjson(string $q = null): string
    {
        if(Yii::$app->request->isAjax) {
            return JsondataService::getLootJson($q);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

}