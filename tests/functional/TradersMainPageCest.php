<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.12.2023
 * Time: 22:56
 */

namespace Tests\Functional;

use app\controllers\TraderController;
use tests\_support\CheckLinks;
use tests\_support\CheckPageCodes;
use tests\_support\FixturesCollection;
use tests\_support\OpengraphChecker;
use tests\_support\OverlayChecker;

/**
 * Функциональные тесты страницы списка торговцев
 *
 * Class TradersMainPageCest
 * @package Tests\Functional
 */
class TradersMainPageCest
{
    /** Метод выполняется перед каждым тестом */
    public function _before(\FunctionalTester $I)
    {
        /** Грузим фикстуры перед каждым тестом */
        $I->haveFixtures(FixturesCollection::getTraders());

        /** Мы на странице списка торговцев */
        $I->amOnRoute(TraderController::routeId(TraderController::ACTION_QUESTS));
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
        // $I->seeInSource('<script>window.yaContextCb = window.yaContextCb || []</script>');
        // $I->seeInSource('<script src="https://yandex.ru/ads/system/context.js" async></script>');
    }

    /** Мы видим что все метатеги в head присутствуют и соответствуют нашим стандартам */
    public function checkMetaTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta name="description" content="Торговцы в Escape from Tarkov - описания торговцев и разбор квестов - прохождения заданий Escape from Tarkov.">');
        $I->seeInSource('<meta name="keywords" content="Квесты Escape from Tarkov, Задачи торговцев, квесты в Таркоеве">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        /** Чекаем корректность OpenGraph тегов */
        OpengraphChecker::checkTags($I, 'Торговцы в Escape from Tarkov - описания торговцев и разбор квестов');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Торговцы в Escape from Tarkov - описания торговцев и разбор квестов');
    }

    /** Мы видим все ссылки горизонтального меню */
    public function checkMenuLinks(\FunctionalTester $I)
    {
        /** Проверяем ссылки горизонтальной навигации на корректность */
        CheckLinks::onMenu($I);
    }

    /** Проверяем активность пункта навигации, для текущей страницы */
    public function checkCurrentPageLinkActive(\FunctionalTester $I)
    {
        $I->seeElement('.dropdown-toggle.active');
    }

    /**
     * Мы видим H1 заголовок и основные элементы данной страницы такие как
     * Заголовок, детальное содержмое страницы, наличие табов, наличие ключевых ссылок на
     * релевантные разделы
     */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Торговцы в Escape from Tarkov - описания торговцев и разбор квестов', 'h1');
    }

    /** У нас нет куки - скрывающей оверлей с рекламой */
    public function checkAdsCoockie(\FunctionalTester $I)
    {
        $I->DontSeeCookie('overlay');
    }

    /** Мы видим блок оверлея с рекламой */
    public function checkOverlayBlock(\FunctionalTester $I)
    {
        // $I->SeeElement('.overlay-block');
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
        /** Проверяем кликабельность кнопки скрытия оверлея */
        OverlayChecker::overlayIsCloseIsClickable($I);
    }

    /** Проверяем что хотя-бы один торговец есть на странице (остальные по аналогии работают) */
    public function checkTradersExists(\FunctionalTester $I)
    {
        /** Ожидания - что при нажатии на кнопку, оверелей скроется */
        $I->expect('Я ожидаю что хотя-бы 1 торговец есть на странице');

        /** Видим линк торговца */
        $I->seeLink('Прапор', '/traders/prapor');

        /** Видим изображение торговца */
        $I->SeeElement('img.image-trader');

        /** Видим линк на детальный раздел торговца */
        $I->seeLink('Перейти в раздел Прапора', '/traders/prapor');

        /** Видим линк на раздел квестов торговца */
        $I->seeLink('Перейти в раздел квестов Прапора', '/quests-of-traders/prapor-quests');
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