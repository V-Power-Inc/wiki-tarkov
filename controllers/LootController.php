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
use app\common\exceptions\http\controllers\app\LootControllerHttpException;
use app\common\interfaces\ResponseStatusInterface;
use app\common\services\redis\RedisVariationsConfig;
use app\common\services\{TradersService, JsondataService};
use app\models\{Category, Items, Traders};
use app\common\services\PaginationService;
use Yii;

/**
 * Class LootController
 * @package app\controllers
 */
final class LootController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    public const ACTION_MAINLOOT  = 'mainloot';
    public const ACTION_CATEGORY  = 'category';
    public const ACTION_QUESTLOOT = 'questloot';
    public const ACTION_LOOTJSON  = 'lootjson';

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
                    self::ACTION_MAINLOOT,
                    self::ACTION_CATEGORY
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

        /** Передаем запрос с лутом в сервис пагинации */
        $data = new PaginationService(Items::getActiveItemsQuery(),50);

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
     * @param string $url - url адрес
     * @return string
     * @throws LootControllerHttpException
     */
    public function actionCategory(string $url): string
    {
        /** Ищем в БД категорию по URL, только среди активных */
        $cat = Category::getActiveCategoryByUrl($url);

        /** Если категория нашлась */
        if ($cat) {

            /** Создаем объект пагинации, в который передаем данные предметов по связке с родительской категорией */
            $data = new PaginationService(Items::takeItemsWithParentCat($url, $cat->id));

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
        throw new LootControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
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
                'questsearch' => TradersService::takeResult($form_model),
                'formValue' => Traders::getTradersList()[$form_model->questitem]
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
     * @throws LootControllerHttpException
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
        throw new LootControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }
}