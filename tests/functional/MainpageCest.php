<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 24.08.2022
 * Time: 21:11
 */

namespace Tests\Functional;

use app\controllers\SiteController;
use tests\_support\CheckLinks;
use tests\_support\CheckPageCodes;

/**
 * Функциональные тесты главной страницы сайта
 *
 * Class MainpageCest
 * @package Tests\Functional
 */
class MainpageCest
{
    /** Мы на главной странице */
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute(SiteController::routeId(SiteController::ACTION_INDEX));
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
        $I->seeInSource('<meta name="description" content="Интерактивные карты локаций, описания квестов торговцев и их прохождения, карта ключей от помещений.">');
        $I->seeInSource('<meta name="keywords" content="Интерактивные карты локаций Escape from Tarkov, квесты Escape from Tarkov, Ключи Escape from Tarkov.">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="База знаний Escape from Tarkov. Карты локаций, ключи от дверей, разбор квестов торговцев">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('База знаний Escape from Tarkov. Карты локаций, ключи от дверей, разбор квестов торговцев');
    }

    /** Мы видим H1 заголовок и кнопку перейти к интерактивным картам */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('База знаний Escape from Tarkov', 'h1');
        $I->see('Перейти к интерактивным картам Escape from Tarkov');
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

    /** Мы видим что все блоки с рекламой присутствуют на странице */
    public function checkOtherAdsBlocks(\FunctionalTester $I)
    {
        $I->seeElement('.no-adb');
    }

    /** Мы видим что все 2 рекламных блока на месте */
    public function checkCountOfAdsBlocks(\FunctionalTester $I)
    {
        $I->seeNumberOfElements('.no-adb', 2);
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