<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.08.2022
 * Time: 19:10
 */

namespace Tests\Functional;

use app\controllers\MapsController;
use tests\_support\CheckLinks;
use tests\_support\CheckPageCodes;
use tests\_support\OpengraphChecker;
use tests\_support\OverlayChecker;

/**
 * Функциональные тесты страницы со списком интерактивных карт
 *
 * Class MapsCest
 * @package Tests\Functional
 */
class MapsCest
{
    /** Мы на главной странице */
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute(MapsController::routeId(MapsController::ACTION_LOCATIONS));
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
        $I->seeInSource('<meta name="description" content="Карты локаций Escape from Tarkov - интерактивные карты Леса, Завода - просмотр маркеров со спавнами">');
        $I->seeInSource('<meta name="keywords" content="Карта Леса Тарков, Карта таможни Тарков, Escape from tarkov интерактивные карты">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        /** Чекаем корректность OpenGraph тегов */
        OpengraphChecker::checkTags($I, 'Карты локаций Escape from Tarkov - интерактивные карты с просмотром ключей от помещений');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Карты локаций Escape from Tarkov - интерактивные карты с просмотром ключей от помещений');
    }

    /** Мы видим все ссылки горизонтального меню */
    public function checkMenuLinks(\FunctionalTester $I)
    {
        /** Проверяем ссылки горизонтальной навигации на корректность */
        CheckLinks::onMenu($I);
    }

    /** Проверяем что все интерактивные карты доступны на странице и на них есть ссылки */
    public function checkMapsList(\FunctionalTester $I)
    {
        $I->see('Карта Завода', 'H2');
        $I->see('Карта Леса', 'H2');
        $I->see('Карта Таможни', 'H2');
        $I->see('Карта Берега', 'H2');
        $I->see('Карта Развязки', 'H2');
        $I->see('Карта лаборатории Terra Group', 'H2');
        $I->see('Карта Резерва', 'H2');
        $I->see('Карта Маяка', 'H2');
        $I->see('Карта Улицы Таркова', 'H2');
        $I->see('Карта Эпицентра', 'H2');
        $I->see('Карта Лабиринта', 'H2');
    }

    /** Проверяем что видим правильное количество превьюшек интерактивных карт */
    public function checkMapsMiniatures(\FunctionalTester $I)
    {
        $I->seeElement('.maps__small');
        $I->seeNumberOfElements('.maps__small', 11);
    }

    /** Проверяем корректность ссылок на детальные страницы интерактивных карт */
    public function checkMapsLinks(\FunctionalTester $I)
    {
        $I->seeLink('Перейти к карте Завода','/maps/zavod-location#3/68.97/-8.00');
        $I->seeLink('Перейти к карте Леса','/maps/forest-location#3/72.50/-9.58');
        $I->seeLink('Перейти к карте Таможни','/maps/tamojnya-location#4/80.40/-75.98');
        $I->seeLink('Перейти к карте Берега','/maps/bereg-location#3/60.93/-10.81');
        $I->seeLink('Перейти к карте Развязки','/maps/razvyazka-location');
        $I->seeLink('Перейти к карте лаборатории Terra Group','/maps/terragroup-laboratory-location#2/41.0/-1.2');
        $I->seeLink('Перейти к карте Резерв','/maps/rezerv-location');
        $I->seeLink('Перейти к карте Маяк','/maps/lighthouse-location');
        $I->seeLink('Перейти к карте Улицы Таркова','/maps/streets-of-tarkov-location');
        $I->seeLink('Перейти к карте Эпицентр','/maps/epicenter#2/61.9/-58.2');
        $I->seeLink('Перейти к карте Лабиринт','/maps/labyrinth-location#2/60.8/-86.0');
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