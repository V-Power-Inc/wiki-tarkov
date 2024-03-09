<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.12.2023
 * Time: 12:31
 */

namespace Tests\Functional;

use app\controllers\SiteController;
use app\tests\fixtures\CurrenciesFixture;
use tests\_support\CheckLinks;
use tests\_support\CheckPageCodes;

/**
 * Функциональные тесты для страницы списка валют
 *
 * Class CurrenciesCest
 * @package Tests\Functional
 */
class CurrenciesCest
{
    /** Метод выполняется перед каждым тестом */
    public function _before(\FunctionalTester $I)
    {
        /** Грузим фикстуры перед каждым тестом */
        $I->haveFixtures([
            'currencies' => [
                'class' => CurrenciesFixture::class,
                'dataFile' => codecept_data_dir() . 'currencies.php'
            ]
        ]);

        /** Путь до страницы с валютами */
        $I->amOnRoute(SiteController::routeId(SiteController::ACTION_CURRENCIES));
    }

    /** Мы проверяем - что код страницы 200 */
    public function checkCodeIsOk(\FunctionalTester $I)
    {
        /** Вызываем класс по проверке кодов страниц */
        CheckPageCodes::start($I);
    }

    /** Мы видим что в мета тегах присутствуют коды яндекс верификации */
    public function checkYandexVerification(\FunctionalTester $I)
    {
        $I->seeInSource('<meta name="yandex-verification" content="114a7ff38e4fe597" />');
    }

    /** Мы видим что на странице определен код РТБ блоков яндекса */
    public function checkYandexRtbScripts(\FunctionalTester $I)
    {
        $I->seeInSource('<script>window.yaContextCb = window.yaContextCb || []</script>');
        $I->seeInSource('<script src="https://yandex.ru/ads/system/context.js" async></script>');
    }

    /** Мы видим что все метатеги в head присутствуют и соответствуют нашим стандартам */
    public function checkMetaTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta name="description" content="В Escape from Tarkov как и в реальном мире - есть свои денежные валюты, у которых также есть активный курс.">');
        $I->seeInSource('<meta name="keywords" content="Курс валют в Escape from Tarkov">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="Курс валют в Escape from Tarkov">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Курс валют в Escape from Tarkov');
    }

    /** Мы видим H1 заголовок и текст описания страницы а также объект клана */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Курс валют в Escape from Tarkov', 'h1');
        $I->see('В Escape from Tarkov как и в реальном мире - есть свои денежные валюты, у которых также есть активный курс.');
    }

    /** Мы видим все ссылки горизонтального меню */
    public function checkMenuLinks(\FunctionalTester $I)
    {
        /** Проверяем ссылки горизонтальной навигации на корректность */
        CheckLinks::onMenu($I);
    }

    /** У нас нет куки - скрывающей оверлей с рекламой */
    public function checkAdsCoockie(\FunctionalTester $I)
    {
        $I->DontSeeCookie('overlay');
    }

    /** Мы видим блок оверлея с рекламой */
    public function checkOverlayBlock(\FunctionalTester $I)
    {
        $I->SeeElement('.overlay-block');
    }

    /** У нас нет куки - темная тема сайта */
    public function checkDarkThemeCoockie(\FunctionalTester $I)
    {
        $I->DontSeeCookie('dark_theme');
    }

    /** Проверяем что видим на странице переключатель темной темы */
    public function checkThemeToggler(\FunctionalTester $I)
    {
        $I->SeeElement('.js-change-site-style');
    }

    /** Проверяем что видим на странице ссылку на страницу обратной связи */
    public function checkFeedbackFormLinkIcon(\FunctionalTester $I)
    {
        $I->SeeElement('.js-feedback-form');
    }

    /** Проверяем что видим на странице кнопку для закрытия оверлейного блока с рекламой */
    public function checkExistingOfCloseOverlayButton(\FunctionalTester $I)
    {
        $I->SeeElement('.cls-btn');
    }

    /** Проверяем что блок оверлея с рекламой скроется и установится кукис, который отключит его на 6 часов */
    public function checkThatOverlayIsCloseIsClickable(\FunctionalTester $I)
    {
        /** Пожелания */
        $I->wantTo('Отключить блок с рекламой оверлея, в нижней части экрана при нажатии на кнопку закрытия');

        /** Видим кнопку закрытия оверлея */
        $I->SeeElement('.cls-btn');

        /** Ожидания - что при нажатии на кнопку, оверелей скроется */
        $I->expect('Я ожидаю что по нажатию на кнопку, оверлей скроется');

        /** Кликаем кнопку скрытия рекламы */
        $I->click('.cls-btn');
    }

    /** Метод проверяет сущестование блока с конвертацией доллара */
    public function checkDollarBlockIsExist(\FunctionalTester $I)
    {
        /** Мы видим заголовок блока */
        $I->see('Курс Доллара', 'h2.curencies-title');

        /** Мы видим описание блока */
        $I->see('Как было сказано выше - доллар это ходовая валюта у торговца Миротворец - ниже вы сможете узнать актуальный курс доллара, а также воспользоваться калькулятором для рассчета цен.');

        /** Мы видим блок с исходным курсом */
        $I->seeElement('//html/body/div[1]/div[3]/div/div[1]/div[1]/div[1]/input');

        /** Мы видим селектор до введения данных */
        $I->seeElement('#dollar-refference');

        /** Мы видим селектор до данных после конвертации */
        $I->seeElement('#outputdollar');
    }

    /** Метод проверяет сущестование блока с конвертацией Евро */
    public function checkEuroBlockIsExist(\FunctionalTester $I)
    {
        /** Мы видим заголовок блока */
        $I->see('Курс Евро', 'h2.curencies-title');

        /** Мы видим описание блока */
        $I->see('Евро валюта является ходовой у торговца Механика, за нее он продает различные дополнения для вашего оружия в виде модулей, однако не только он продает товары за евро, у Лыжника также можно найти несколько товаров продаваемых за евро.');

        /** Мы видим блок с исходным курсом */
        $I->seeElement('//html/body/div[1]/div[3]/div/div[1]/div[2]/div[1]/input');

        /** Мы видим селектор до введения данных */
        $I->seeElement('#euro-refference');

        /** Мы видим селектор до данных после конвертации */
        $I->seeElement('#outputeuro');
    }

    /** Метод проверяет сущестование блока с конвертацией BTC */
    public function checkBtcBlockIsExist(\FunctionalTester $I)
    {
        /** Мы видим заголовок блока */
        $I->see('Курс Биткоина', 'h2.curencies-title');

        /** Мы видим описание блока */
        $I->see('Это самая дорогостоющая валюта, стоимость 1 биткоина в Таркове составляет десятки тысяч рублей. Валюта в ходу у Механика, за нее у него можно купить оружие с отличными боевыми характеристиками. Зачастую ЧВК используют биткоины также для того, чтобы поправить свое финансовое положение - следовательно продавать биткоин тоже очень выгодно.');

        /** Мы видим блок с исходным курсом */
        $I->seeElement('//html/body/div[1]/div[3]/div/div[1]/div[3]/div[1]/input');

        /** Мы видим селектор до введения данных */
        $I->seeElement('#bitkoin-refference');

        /** Мы видим селектор до данных после конвертации */
        $I->seeElement('#outputbitkoin');
    }

    /** Метод проверяет сущестование блока с конвертацией в рубли */
    public function checkOnRoublesBlockIsExist(\FunctionalTester $I)
    {
        /** Мы видим заголовок блока */
        $I->see('С рублей на другие валюты', 'h2.curencies-title');

        /** Мы видим описание блока */
        $I->see('В этом блоке вы можете ввести количество рублей, чтобы узнать сколько других валют сможете купить по текущим курсам.');

        /** Мы видим блок с инпутом для конвертации в другие валюты */
        $I->seeElement('#roubles_input');

        /** Мы видим блок результатов Доллара */
        $I->seeElement('#dollar_res');

        /** Мы видим блок результатов Euro */
        $I->seeElement('#euro_res');

        /** Мы видим блок результатов BTC */
        $I->seeElement('#btc_res');
    }

    /** Проверяем что кнопка скролла вверх на странице присутствует */
    public function checkScrollToTopExists(\FunctionalTester $I)
    {
        /** Видим что футер присутствует */
        $I->SeeElement('.scup');
    }

    /** Проверяем правильную работу footer */
    public function checkFooterLinks(\FunctionalTester $I)
    {
        /** Проверяем состояние footer */
        CheckLinks::onFooter($I);
    }
}