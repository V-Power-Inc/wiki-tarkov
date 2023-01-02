<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.08.2022
 * Time: 19:00
 */

namespace Tests\Functional;

use app\controllers\TraderController;
use app\tests\fixtures\TradersFixture;
use app\tests\fixtures\BaraholshikFixture;
use app\tests\fixtures\InfoFixture;

/**
 * Функциональные тесты страниц квестов
 *
 * Class BaraholshikCest
 * @package Tests\Functional
 */
class BaraholshikCest
{
    /**
     * Фикстуры для таблицы baraholshik
     * @return array
     */
    public function _fixtures() {
        return [
            'traders' => [
                'class' => TradersFixture::class,
                'dataFile' => codecept_data_dir() . 'traders.php'
            ],
            'baraholshik' => [
                'class' => BaraholshikFixture::class,
                'dataFile' => codecept_data_dir() . 'baraholshik.php'
            ],
            'info' => [
                'class' => InfoFixture::class,
                'dataFile' => codecept_data_dir() . 'info.php'
            ]
        ];
    }

    /** Мы на главной странице */
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute(TraderController::routeId(TraderController::ACTION_BARAHOLSHIKPAGE));
    }

    /** Мы видим что все метатеги в head присутствуют и соответствуют нашим стандартам */
    public function checkMetaTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta name="description" content="Прохождение и разбор квестов Барахольщика по онлайн-шутеру Escape from Takov.">');
        $I->seeInSource('<meta name="keywords" content="Квесты Барахольщика в Escape from Tarkov, квесты Барахольщика Тарков">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="Квесты Барахольщика в Escape from Tarkov. Разбор и прохождение квестов Барахольщика.">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Квесты Барахольщика в Escape from Tarkov. Разбор и прохождение квестов Барахольщика.');
    }

    /** Мы видим H1 заголовок и названия квестов а также область контента, что их выводит */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Квесты Барахольщика в Escape from Tarkov. Разбор и прохождение квестов Барахольщика.', 'h1');
        $I->see('Только бизнес');
        $I->see('Вернем Ультре былое величие');
        $I->see('Распродажа');
        $I->seeElement('.quests-content');
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
        $I->seeLink('Улицы Таркова', '/maps/streets-of-tarkov-location#2/8.1/13.9');
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
}