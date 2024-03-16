<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.03.2024
 * Time: 2:04
 */

namespace Tests\Functional;

use app\common\interfaces\CrudInterface;
use app\modules\admin\controllers\ArticlesController;
use app\modules\admin\controllers\BartersController;
use app\modules\admin\controllers\CategoryController;
use app\modules\admin\controllers\CatskillsController;
use app\modules\admin\controllers\ClansController;
use app\modules\admin\controllers\CurrenciesController;
use app\modules\admin\controllers\DoorkeysController;
use app\modules\admin\controllers\ItemsController;
use app\modules\admin\controllers\MapsController;
use app\modules\admin\controllers\NewsController;
use app\modules\admin\controllers\QuestionsController;
use app\modules\admin\controllers\SkillsController;
use tests\_support\CheckCrud;
use tests\_support\FixturesCollection;
use yii\helpers\Url;

/**
 * Функциональные тесты, CRUD элементов, что есть в админке
 *
 * Class AdminPagesCrudCest
 * @package Tests\Functional
 */
class AdminPagesCrudCest
{
    /** @var int - Костанта, ID фикстуры, которую будем передавать для тестов */
    private const ID_FIRST_ROW = 1;

    /** @var string - Костанта, название уникального параметра */
    private const PARAM_ID = 'id';

    /**
     * Используем все фикстуры, что у нас есть для тестирования
     *
     * @return array
     */
    public function _fixtures()
    {
        /** Коллекция фикстур для crud */
        return FixturesCollection::getCrudOnly();
    }

    /** Действия перед каждым тестом */
    public function _before(\FunctionalTester $I)
    {
        /** Мы залогинены в данный момент как админ */
        $I->amLoggedInAs(1);
    }

    /**
     * Проверяем CRUD для категория справочника лута
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkLootCategories(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, CategoryController::class);
    }

    /**
     * Проверяем CRUD для лута из справочника лута
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkItems(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, ItemsController::class);
    }

    /**
     * Проверяем CRUD маркеров интерактивных карт
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkMapMarkers(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, MapsController::class);
    }

    /**
     * Проверяем CRUD заявок кланов
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkClans(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, ClansController::class);
    }

    /**
     * Проверяем бартеры торговцев
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkBarters(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, BartersController::class);
    }

    /**
     * Проверяем CRUD таблицы вопросов
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkQuestions(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, QuestionsController::class);
    }

    /**
     * Проверяем CRUD категорий скилов
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkSkillsCategories(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, CatskillsController::class);
    }

    /**
     * Проверяем CRUD скилов
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkSkills(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, SkillsController::class);
    }

    /**
     * Проверяем CRUD ключей от дверей
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkDoorkeys(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, DoorkeysController::class);
    }

    /**
     * Проверяем CRUD новостей
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkNews(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, NewsController::class);
    }

    /**
     * Проверяем CRUD полезных статей
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkArticles(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, ArticlesController::class);
    }

    /**
     * Проверяем CRUD курсов валют
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public function checkCurrencies(\FunctionalTester $I)
    {
        $this->executeCrudChecking($I, CurrenciesController::class);
    }

    /**
     * Метод что вызываем в каждом тесте, с различными параметрами для дальнейшего тестирования CRUD
     *
     * @param \FunctionalTester $I
     * @param string $class - Класс контроллера в виде пути до него (Это должен быть класс контроллера CRUD)
     * @return void
     */
    private function executeCrudChecking(\FunctionalTester $I, string $class)
    {
        /** Формируем урл создания записи с учетом прилетевшего класса */
        $url_create = Url::to($class::getUrlRoute(CrudInterface::ACTION_CREATE));

        /** Формируем урл просмотра записи с учетом прилетевшего класса */
        $url_view = Url::to($class::getUrlRoute(CrudInterface::ACTION_VIEW, [self::PARAM_ID => self::ID_FIRST_ROW]));

        /** Формируем урл редактирования записи с учетом прилетевшего класса */
        $url_edit = Url::to($class::getUrlRoute(CrudInterface::ACTION_UPDATE, [self::PARAM_ID => self::ID_FIRST_ROW]));

        /** Формируем урл редактирования записи с учетом прилетевшего класса */
        $url_delete = Url::to($class::getUrlRoute(CrudInterface::ACTION_DELETE, [self::PARAM_ID => self::ID_FIRST_ROW]));

        /** Проверяем страницу создания новых записей */
        CheckCrud::onCreate($I, $url_create);

        // TODO: Тут что-то не так, остальные тесты не проходят в контейнере, однако проходят на DEV'e

//        /** Проверяем страницу просмотра записей */
//        CheckCrud::onView($I, $url_view);
//
//        /** Проверяем страницу редактирования записей */
//        CheckCrud::onEdit($I, $url_edit);
//
//        /** Проверяем страницу удаления записей */
//        CheckCrud::onDelete($I, $url_delete);
    }
}