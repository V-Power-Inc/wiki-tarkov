<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.08.2022
 * Time: 19:10
 */

namespace Tests\Functional;

use app\controllers\MapsController;

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

    /** Мы видим что все метатеги в head присутствуют и соответствуют нашим стандартам */
    public function checkMetaTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta name="description" content="Карты локаций Escape from Tarkov - интерактивные карты Леса, Завода - просмотр маркеров со спавнами">');
        $I->seeInSource('<meta name="keywords" content="Карта Леса Тарков, Карта таможни Тарков, Escape from tarkov интерактивные карты">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="Карты локаций Escape from Tarkov - интерактивные карты с просмотром ключей от помещений">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Карты локаций Escape from Tarkov - интерактивные карты с просмотром ключей от помещений');
    }

    /** Мы видим все ссылки горизонтального меню */
    public function checkMenuLinks(\FunctionalTester $I)
    {
        $I->seeLink('Курсы валют','/currencies');
        $I->seeLink('Полезная информация','/articles');
        $I->seeLink('Новости','/news');
        $I->seeLink('Частые вопросы','/questions');
        $I->seeLink('Таблица патронов','/table-patrons');
        $I->seeLink('Список кланов','/clans');
        $I->seeLink('Завод','/maps/zavod-location#3/68.97/-8.00');
        $I->seeLink('Таможня','/maps/tamojnya-location#4/80.40/-75.98');
        $I->seeLink('Лес','/maps/forest-location#3/72.50/-9.58');
        $I->seeLink('Берег','/maps/bereg-location#3/60.93/-10.81');
        $I->seeLink('Развязка','/maps/razvyazka-location#3/75.32/-44.38');
        $I->seeLink('Лаборатория Terra Group','/maps/terragroup-laboratory-location#2/41.0/-1.2');
        $I->seeLink('Резерв','/maps/rezerv-location#2/64.6/41.0');
        $I->seeLink('Маяк','/maps/lighthouse-location#2/74.0/65.2');
        $I->seeLink('Смотреть список доступных карт','/maps');
        $I->seeLink('Прапор','/traders/prapor');
        $I->seeLink('Терапевт','/traders/terapevt');
        $I->seeLink('Скупщик','/traders/skupshik');
        $I->seeLink('Лыжник','/traders/lyjnic');
        $I->seeLink('Миротворец','/traders/mirotvorec');
        $I->seeLink('Механик','/traders/mehanic');
        $I->seeLink('Барахольщик','/traders/baraholshik');
        $I->seeLink('Смотреть всех торговцев','/quests-of-traders');
        $I->seeLink('Физические умения','/skills/physical');
        $I->seeLink('Ментальные умения','/skills/mental');
        $I->seeLink('Практические умения','/skills/practical');
        $I->seeLink('Боевые умения','/skills/combat');
        $I->seeLink('Особые умения','/skills/special');
        $I->seeLink('Смотреть все умения','/skills');
        $I->seeLink('Справочник лута','/loot');
        $I->seeLink('Справочник ключей','/keys');
        $I->seeLink('Боссы на локациях', '/bosses');
        $I->seeLink('Актуальный лут', '/items');
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
    }

    /** Проверяем что видим правильное количество превьюшек интерактивных карт */
    public function checkMapsMiniatures(\FunctionalTester $I)
    {
        $I->seeElement('.maps__small');
        $I->seeNumberOfElements('.maps__small', 8);
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