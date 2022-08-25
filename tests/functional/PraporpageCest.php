<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 25.08.2022
 * Time: 13:23
 */

namespace Tests\Functional;

use app\controllers\TraderController;

/**
 * Функциональные тесты страницы детальных торговцев
 *
 * Class PraporpageCest
 * @package Tests\Functional
 */
class TraderCest
{
    /** Мы на странице Прапора */
    public function _before(\FunctionalTester $I)
    {
        // todo: Проблема
        $I->amOnRoute('/traders/prapor');
    }

    /** Мы видим что все метатеги в head присутствуют и соответствуют нашим стандартам */
    public function checkMetaTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta name="description" content="Прапор. Escape from Tarkov.">');
        $I->seeInSource('<meta name="keywords" content="Прапор из Escape from Tarkov, Что продаёт Прапор в Escape from Tarkov, все о торговце Прапоре.">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="Торговцы Escape from Tarkov: Прапор">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Торговцы Escape from Tarkov: Прапор');
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
    }

    /** Проверяем активность пункта навигации, для текущей страницы */
    public function checkCurrentPageLinkActive(\FunctionalTester $I)
    {
        $I->seeLink('<b>Торговцы</b><span class="caret"></span>', '#');
    }

    /**
     * Мы видим H1 заголовок и основные элементы данной страницы такие как
     * Заголовок, детальное содержмое страницы, наличие табов, наличие ключевых ссылок на
     * релевантные разделы
     */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Торговцы Escape from Tarkov: Прапор', 'h1');

        $I->seeElement('.news-shortitem.bg-white');
        $I->seeElement('.barters-block');
        $I->seeElement('.tab-content');

        $I->seeLink('Вернуться к списку торговцев','/quests-of-traders');
        $I->seeLink('Перейти в раздел квестов Прапора','/quests-of-traders/prapor-quests');
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

}