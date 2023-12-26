<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.12.2023
 * Time: 18:22
 */

namespace Tests\Functional;

use app\common\controllers\AdminController;
use app\modules\admin\controllers\CurrenciesController;
use app\modules\admin\controllers\ArticlesController;
use app\modules\admin\controllers\BartersController;
use app\modules\admin\controllers\CategoryController;
use app\modules\admin\controllers\CatskillsController;
use app\modules\admin\controllers\ClansController;
use app\modules\admin\controllers\DefaultController;
use app\modules\admin\controllers\DoorkeysController;
use app\modules\admin\controllers\FeedbackmessagesController;
use app\modules\admin\controllers\ItemsController;
use app\modules\admin\controllers\NewsController;
use app\modules\admin\controllers\QuestionsController;
use app\modules\admin\controllers\SkillsController;
use app\modules\admin\controllers\TradersController;
use app\tests\fixtures\AdminsFixture;

/**
 * Функциональные тесты для проверки страниц админки
 *
 * Class AdminPagesCest
 * @package Tests\Functional
 */
class AdminPagesCest
{
    /**
     * Фикстуры с пользователями сайта
     * @return array
     */
    public function _fixtures()
    {
        return [
            'admins' => [
                'class' => AdminsFixture::class,
                'dataFile' => codecept_data_dir() . 'admins.php'
            ]
        ];
    }

    /** Метод проверяет что на страницы админки мы не можем зайти без авторизации */
    public function checkAdminPagesWithoutLogin(\FunctionalTester $I)
    {
        /** В цикле проходим каждый URL из админки (Каждый в отдельном контроллере) */
        foreach ($this->getUrlList() as $url) {

            /** Заходим на страницу URL'a */
            $I->amOnRoute($url);

            /** Проверка что мы на странице логина и не видим штуки из интерфейса залогинненого пользователя */
            $this->expectCantSeeAdminPages($I);
        }
    }

    /** Метод проверяет что на страницы админки мы не можем зайти без авторизации */
    public function checkAdminPagesWithLogin(\FunctionalTester $I)
    {
        /** Мы залогинены в данный момент как админ */
        $I->amLoggedInAs(1);

        /** В цикле проходим каждый URL из админки (Каждый в отдельном контроллере) */
        foreach ($this->getUrlList() as $url) {

            /** Заходим на страницу URL'a */
            $I->amOnRoute($url);

            /** Проверка что мы на странице внутри админки и можем видеть то содержимое, которое видит только админ */
            $this->canSeeAdminMenuInLogginedInterface($I);
        }
    }

    /** Метод проверяет что мы видим редирект и оказываемся на странице логина */
    private function expectCantSeeAdminPages(\FunctionalTester $I)
    {
        /** Проверяем что не видим элементов из админского интерфейса (Его могут видеть только залогиненные пользователи) */
        $this->cantSeeAdminMenuInLogginedInterface($I);

        /** Вижу что редирект был на страницу логина */
        $I->seeCurrentUrlEquals(AdminController::LOGIN_URL);
    }

    /** Метод проверяет что мы не видим то меню, которое может видеть залогиненный пользователь */
    private function cantSeeAdminMenuInLogginedInterface(\FunctionalTester $I)
    {
        /** Проверяем что не видим линки из навигации для админа на сайте */
        $I->cantSee('Открыть сайт');
        $I->cantSee('Справочник квестов');
        $I->cantSee('База ключей');
        $I->cantSee('Список новостей');
        $I->cantSee('Выход');

        /** Проверка что видим атрибуты страницы авторизации */
        $this->canSeeLoginPageAttributes($I);
    }

    /** Метод проверяет что мы видим все необходимые атрибуты страницы авторизации в админку */
    private function canSeeLoginPageAttributes(\FunctionalTester $I)
    {
        /** Проверяем что видим надпись - админка сайта */
        $I->canSee('Админка сайта');

        /** Проверяем, что есть заголовок формы авторизации */
        $I->canSee('Авторизация', 'h1');

        /** Проверяем, что есть инпут для ввода логина */
        $I->canSeeElement('#login-email');

        /** Проверяем, что есть инпут для ввода пароля */
        $I->canSeeElement('#login-password');

        /** Проверяем, что есть инпут для ввода рекапчи от Google */
        $I->canSeeElement('#login-recaptcha');

        /** Мы видим кнопку войти для авторизации */
        $I->canSee('Войти', 'button');
    }

    /** Метод проверяет что мы ВИДИМ МЕНЮ, которое может видеть залогиненный пользователь */
    private function canSeeAdminMenuInLogginedInterface(\FunctionalTester $I)
    {
        /** Проверяем что видим линки из навигации для админа на сайте */
        $I->canSee('Открыть сайт');
        $I->canSee('Справочник квестов');
        $I->canSee('База ключей');
        $I->canSee('Список новостей');
        $I->canSee('Выход');

        /** Проверка что НЕ ВИДИМ атрибуты страницы авторизации */
        $this->cantSeeLoginPageAttributes($I);
    }

    /** Метод проверяет что мы видим все необходимые атрибуты страницы авторизации в админку */
    private function cantSeeLoginPageAttributes(\FunctionalTester $I)
    {
        /** Проверяем что видим надпись - админка сайта */
        $I->canSee('Админка сайта');

        /** Проверяем, что нет заголовока формы авторизации */
        $I->cantSee('Авторизация', 'h1');

        /** Проверяем, что нет инпута для ввода логина */
        $I->cantSeeElement('#login-email');

        /** Проверяем, что нет инпута для ввода пароля */
        $I->cantSeeElement('#login-password');

        /** Проверяем, что нет инпута для ввода рекапчи от Google */
        $I->cantSeeElement('#login-recaptcha');

        /** Мы не видим кнопку войти для авторизации */
        $I->cantSee('Войти', 'button');
    }

    /**
     * Метод возвращаем массив с урлами, по которым мы будем идти, чтобы их проверить на возможность посмотреть контент
     * Всегда возвращает
     *
     * @return array
     */
    private function getUrlList(): array
    {
        /** Возвращаем массив с урлами для проверки */
        return [
            CurrenciesController::routeId(CurrenciesController::ACTION_INDEX),
            BartersController::routeId(BartersController::ACTION_INDEX),
            ArticlesController::routeId(ArticlesController::ACTION_INDEX),
            CategoryController::routeId(CategoryController::ACTION_INDEX),
            CatskillsController::routeId(CatskillsController::ACTION_INDEX),
            ClansController::routeId(ClansController::ACTION_INDEX),
            DefaultController::routeId(DefaultController::ACTION_INDEX),
            DoorkeysController::routeId(DoorkeysController::ACTION_INDEX),
            ItemsController::routeId(ItemsController::ACTION_INDEX),
            NewsController::routeId(NewsController::ACTION_INDEX),
            QuestionsController::routeId(QuestionsController::ACTION_INDEX),
            SkillsController::routeId(SkillsController::ACTION_INDEX),
            TradersController::routeId(TradersController::ACTION_INDEX),
            FeedbackmessagesController::routeId(FeedbackmessagesController::ACTION_INDEX)
        ];
    }
}