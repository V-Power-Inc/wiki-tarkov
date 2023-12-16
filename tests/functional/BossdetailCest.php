<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 30.11.2022
 * Time: 10:43
 */

namespace Tests\Functional;

use app\tests\fixtures\BossesFixture;

class BossdetailCest
{
    /** Метод выполняется перед каждым тестом */
    public function _before(\FunctionalTester $I)
    {
        /** Грузим фикстуры перед каждым тестом */
        $I->haveFixtures([
            'boss' => [
                'class' => BossesFixture::class,
                'dataFile' => codecept_data_dir() . 'bosses.php'
            ]
        ]);

        /** Мы на главной странице боссов */
        $I->amOnRoute('/bosses/rezerv');
    }

    /** Мы проверяем - что код страницы 200 */
    public function checkCodeIsOk(\FunctionalTester $I)
    {
        $I->canSeeResponseCodeIs(200);
    }

    /** Мы видим что все метатеги в head присутствуют и соответствуют нашим стандартам */
    public function checkMetaTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta name="description" content="Боссы, которые встречаются на локации Резерв в Escape from Tarkov">');
        $I->seeInSource('<meta name="keywords" content="Боссы, Резерв, Escape from Tarkov">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="Боссы на локации Резерв Escape from Tarkov">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Боссы на локации Резерв Escape from Tarkov');
    }

    /** Мы видим H1 заголовок и описание одного из боссов, его заголовок и блок с данными о нем */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Боссы на локации Резерв Escape from Tarkov', 'h1');
        $I->see('Глухарь');
        $I->seeElement('.boss-page-bg');
        $I->seeElement('.alert.alert-danger.size-16');
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
        $I->seeLink('Обратная связь', '/feedback-form');
        $I->seeLink('Завод', '/maps/zavod-location#3/68.97/-8.00');
        $I->seeLink('Таможня', '/maps/tamojnya-location#4/80.40/-75.98');
        $I->seeLink('Лес', '/maps/forest-location#3/72.50/-9.58');
        $I->seeLink('Берег', '/maps/bereg-location#3/60.93/-10.81');
        $I->seeLink('Развязка', '/maps/razvyazka-location#3/75.32/-44.38');
        $I->seeLink('Лаборатория Terra Group', '/maps/terragroup-laboratory-location#2/41.0/-1.2');
        $I->seeLink('Резерв', '/maps/rezerv-location#2/64.6/41.0');
        $I->seeLink('Маяк', '/maps/lighthouse-location#2/74.0/65.2');
        $I->seeLink('Улицы Таркова', '/maps/streets-of-tarkov-location#2/59.2/34.3');
        $I->seeLink('Смотреть список доступных карт', '/maps');
        $I->seeLink('Прапор', '/traders/prapor');
        $I->seeLink('Терапевт', '/traders/terapevt');
        $I->seeLink('Скупщик', '/traders/skupshik');
        $I->seeLink('Лыжник', '/traders/lyjnic');
        $I->seeLink('Миротворец', '/traders/mirotvorec');
        $I->seeLink('Механик', '/traders/mehanic');
        $I->seeLink('Барахольщик', '/traders/baraholshik');
        $I->seeLink('Егерь', '/traders/eger');
        $I->seeLink('Квесты Смотрителя', '/quests-of-traders/seeker-quests');
        $I->seeLink('Смотреть всех торговцев', '/quests-of-traders');
        $I->seeLink('Физические умения', '/skills/physical');
        $I->seeLink('Ментальные умения', '/skills/mental');
        $I->seeLink('Практические умения', '/skills/practical');
        $I->seeLink('Боевые умения', '/skills/combat');
        $I->seeLink('Особые умения', '/skills/special');
        $I->seeLink('Смотреть все умения', '/skills');
        $I->seeLink('Справочник лута', '/loot');
        $I->seeLink('Справочник ключей', '/keys');
        $I->seeLink('Боссы на локациях', '/bosses');
        $I->seeLink('Актуальный лут', '/items');
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
}