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
use app\common\interfaces\ResponseStatusInterface;
use app\common\services\JsondataService;
use app\common\services\redis\RedisVariationsConfig;
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
final class LootController extends AdvancedController
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
                'duration' => Yii::$app->params['cacheTime']['seven_days'],
                'only' => [
                    static::ACTION_MAINLOOT,
                    static::ACTION_CATEGORY
                ],
                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT MAX(date_update) FROM items',
                ],
                'variations' => RedisVariationsConfig::getMainControllerVariations()
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
        /** Создаем объект лута */
        $model = new Items();

        /** Ищем только активный лут */
        $fullitems = Items::find()->where([Items::ATTR_ACTIVE => Items::TRUE]);

        /** Передаем запрос с лутом в сервис пагинации */
        $data = new PaginationService($fullitems,50);

        /** Рендерим вьюху */
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
        /** Ищем в БД категорию по URL, только среди активных */
        $cat = Category::find()->where([Category::ATTR_URL => $name])->andWhere([Category::ATTR_ENABLED => Category::TRUE])->One();

        /** Если категория нашлась */
        if ($cat) {

            /** Создаем объект пагинации, в который передаем данные предметов по связке с родительской категорией */
            $data = new PaginationService(Items::takeItemsWithParentCat($name, $cat->id));

            /** Рендерим вьюху */
            return $this->render('categorie-page.php', [
                'cat' => $cat,
                'items' => $data->items,
                'active_page' => Yii::$app->request->get('page',1),
                'count_pages' => $data->paginator->getPageCount(),
                'pagination' => $data->paginator
            ]);
        }

        /** Выкидываем 404 ошибку, если активная категория не нашлась */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Рендер страницы списка предметов для квестов торговцев
     *
     * @return string
     */
    public function actionQuestloot(): string
    {
        /** Создаем объект лута */
        $form_model = new Items();

        /** Если сюда залетели данные через POST */
        if ($form_model->load(Yii::$app->request->post())) {

            /** Рендерим страницу с квестовым лутом по определенному торговцу */
            return $this->render('quest-page', [
                'form_model' => $form_model,
                'questsearch' => TraderService::takeResult($form_model),
                'formValue' => (string)Traders::traderGroups()[$form_model->questitem]
            ]);
        }

        /** Если запроса POST не было, рендерим базовую страницу с квестовым лутом */
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
        /** Если запрос о луте прилетел через AJAX */
        if (Yii::$app->request->isAjax) {

            /** Передаем запрос в сервис работы с JSON, который вернет нам JSON с нужными данными */
            return JsondataService::getLootJson($q);
        }

        /** Выкидываем 404 ошибку, если запрос прилетел не через AJAX */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }
}