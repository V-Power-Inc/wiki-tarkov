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

/**
 * Функциональные тесты для проверки страниц админки
 *
 * Class AdminPagesCest
 * @package Tests\Functional
 */
class AdminPagesCest
{
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