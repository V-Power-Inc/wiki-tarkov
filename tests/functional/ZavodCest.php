<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.08.2022
 * Time: 19:34
 */

namespace Tests\Functional;

use app\controllers\MapsController;

/**
 * Функциональные тесты интерактивной карты Завод
 *
 * Class ZavodCest
 * @package Tests\Functional
 */
class ZavodCest
{
    /** Мы на главной странице */
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute(MapsController::routeId(MapsController::ACTION_ZAVOD));
    }

    /** Мы видим что все метатеги в head присутствуют и соответствуют нашим стандартам */
    public function checkMetaTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta name="description" content="Интерактивная карта локации Завод из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, дверей открываемых ключами.">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="Карта локации Завод в Escape from Tarkov - интерактивная карта со спавнами Диких, точками военных ящиков и ключей">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Карта локации Завод в Escape from Tarkov - интерактивная карта со спавнами Диких, точками военных ящиков и ключей');
    }

    /** Мы видим правое меню, с опциями интерактивной карты */
    public function checkRightMenuExtsts(\FunctionalTester $I)
    {
        $I->seeElement('.optins_layerstability');
    }

    /** Мы видим H1 заголовок и кнопку перейти к интерактивным картам */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Карта локации Завод', 'h1');
        $I->see('Маркеры', 'h2');
        $I->see('Интерактивная карта Завода', 'h2');
    }

    /** Мы видим, что поисковое поле поиска лута есть на странице */
    public function checkSearchLootInput(\FunctionalTester $I)
    {
        $I->seeElement('.search-map-loot');
    }

    /** Мы видим что фильтрующие кнопки для страницы маркеров присутствуют на странице */
    public function checkFilterMapButtons(\FunctionalTester $I)
    {
        $I->seeElement('.gamers-b');
        $I->seeElement('.dikie-b');
        $I->seeElement('.gamers-b');
        $I->seeElement('.bandits-b');
        $I->seeElement('.exits-b');
        $I->seeElement('.voenka-b');
        $I->seeElement('.polki-b');
        $I->seeElement('.keys-b');
        $I->seeElement('.places-b');
        $I->seeElement('.count-on');
        $I->seeElement('.markers-on');
        $I->seeElement('.count-off');
        $I->seeElement('.markers-off');
    }

    /** Мы видим описание в нижней части меню-блока интерактивной карты */
    public function checkDescriptionMapBlock(\FunctionalTester $I)
    {
        $I->seeElement('.alert.alert-info');
    }

    /** Мы видим все ссылки горизонтального меню */
    public function checkMenuLinks(\FunctionalTester $I)
    {
        $I->seeLink('Курсы валют', '/currencies');
        $I->seeLink('Полезная информация', '/articles');
        $I->seeLink('Новости', '/news');
        $I->seeLink('Частые вопросы', '/questions');
        $I->seeLink('Таблица патронов', '/table-patrons');
        $I->seeLink('Список кланов', '/clans');
        $I->seeLink('Завод', '/maps/zavod-location#3/68.97/-8.00');
        $I->seeLink('Таможня', '/maps/tamojnya-location#4/80.40/-75.98');
        $I->seeLink('Лес', '/maps/forest-location#3/72.50/-9.58');
        $I->seeLink('Берег', '/maps/bereg-location#3/60.93/-10.81');
        $I->seeLink('Развязка', '/maps/razvyazka-location#3/75.32/-44.38');
        $I->seeLink('Лаборатория Terra Group', '/maps/terragroup-laboratory-location#2/41.0/-1.2');
        $I->seeLink('Резерв', '/maps/rezerv-location#2/64.6/41.0');
        $I->seeLink('Маяк', '/maps/lighthouse-location#2/74.0/65.2');
        $I->seeLink('Смотреть список доступных карт', '/maps');
        $I->seeLink('Прапор', '/traders/prapor');
        $I->seeLink('Терапевт', '/traders/terapevt');
        $I->seeLink('Скупщик', '/traders/skupshik');
        $I->seeLink('Лыжник', '/traders/lyjnic');
        $I->seeLink('Миротворец', '/traders/mirotvorec');
        $I->seeLink('Механик', '/traders/mehanic');
        $I->seeLink('Барахольщик', '/traders/baraholshik');
        $I->seeLink('Смотреть всех торговцев', '/quests-of-traders');
        $I->seeLink('Физические умения', '/skills/physical');
        $I->seeLink('Ментальные умения', '/skills/mental');
        $I->seeLink('Практические умения', '/skills/practical');
        $I->seeLink('Боевые умения', '/skills/combat');
        $I->seeLink('Особые умения', '/skills/special');
        $I->seeLink('Смотреть все умения', '/skills');
        $I->seeLink('Справочник лута', '/loot');
        $I->seeLink('Справочник ключей', '/keys');
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
}