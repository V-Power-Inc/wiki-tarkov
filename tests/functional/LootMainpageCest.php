<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.09.2022
 * Time: 18:52
 */

namespace Tests\Functional;

use app\controllers\LootController;
use tests\_support\CheckLinks;
use tests\_support\CheckPageCodes;
use tests\_support\FixturesCollection;
use tests\_support\OpengraphChecker;
use tests\_support\OverlayChecker;

/**
 * Функциональные тестирование главной страницы справочника лута
 *
 * Class LootMainpageCest
 * @package Tests\Functional
 */
class LootMainpageCest
{
    /** Метод выполняется перед каждым тестом */
    public function _before(\FunctionalTester $I)
    {
        /** Грузим фикстуры перед каждым тестом */
        $I->haveFixtures(FixturesCollection::getItemsWithCats());

        /** Мы на главной странице справочника лута */
        $I->amOnRoute(LootController::routeId(LootController::ACTION_MAINLOOT));
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
        $I->seeInSource('<meta name="description" content="Полная база лута по Escape from Tarkov - контент постоянно актуализируется">');
        $I->seeInSource('<meta name="keywords" content="Escape from Tarkov: Полная база данных лута">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        /** Чекаем корректность OpenGraph тегов */
        OpengraphChecker::checkTags($I, 'Справочник лута Escape from Tarkov. База внутриигровых предметов.');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Справочник лута Escape from Tarkov. База внутриигровых предметов.');
    }

    /** Мы видим левое меню, с категориями справочника лута */
    public function checkLeftMenuExists(\FunctionalTester $I)
    {
        $I->seeElement('#categories-menu');
    }

    /** Проверяем существование активных категорий на странице */
    public function checkCategoriesExists(\FunctionalTester $I)
    {
        $I->seeLink('Основная категория', '/loot/main-category');
        $I->seeLink('Основная категория - second', '/loot/main-category-second');
    }

    /** Мы видим H1 заголовок и кнопку перейти к интерактивным картам */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Справочник лута Escape from Tarkov. База внутриигровых предметов.', 'h1');
        $I->seeLink('Квестовые предметы', '/loot/quest-loot');
    }

    /** Мы видим, что поисковое поле поиска лута есть на странице */
    public function checkSearchLootInput(\FunctionalTester $I)
    {
        $I->see('Поиск предметов в справочнике по названию', '.control-label');
        $I->seeElement('.top-content');
    }

    /** Мы видим что основное описание страницы присутствует на ней */
    public function checkPageContentDescription(\FunctionalTester $I)
    {
        $I->seeElement('.alert.alert-info.size-16.margin-top-20');
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
        $I->SeeElement('.cls-btn');
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