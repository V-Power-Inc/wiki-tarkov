<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.12.2023
 * Time: 2:01
 */

namespace Tests\Functional;

use app\controllers\SiteController;
use tests\_support\CheckLinks;
use tests\_support\CheckPageCodes;
use tests\_support\OpengraphChecker;
use tests\_support\OverlayChecker;

/**
 * Функциональные тесты страницы списка ключей
 *
 * Class DoorkeysCest
 * @package Tests\Functional
 */
class DoorkeysCest
{
    /** Мы на странице списка ключей */
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute(SiteController::routeId(SiteController::ACTION_KEYS));
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
        $I->seeInSource('<meta name="description" content="Справочник ключей Escape from Tarkov. Ключи от помещений в Таркове">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        /** Чекаем корректность OpenGraph тегов */
        OpengraphChecker::checkTags($I, 'Справочник ключей Escape from Tarkov. Ключи от дверей в Таркове');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Справочник ключей Escape from Tarkov. Ключи от дверей в Таркове');
    }

    /** Мы видим H1 заголовок и кнопку перейти к интерактивным картам */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Справочник ключей Escape from Tarkov. Ключи от дверей в Таркове', 'h1');
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
        // $I->SeeElement('.cls-btn');
    }

    /** Проверяем что блок оверлея с рекламой скроется и установится кукис, который отключит его на 6 часов */
    public function checkThatOverlayIsCloseIsClickable(\FunctionalTester $I)
    {
        /** Проверяем кликабельность кнопки скрытия оверлея */
        OverlayChecker::overlayIsCloseIsClickable($I);
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