<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.08.2022
 * Time: 17:56
 */

namespace Tests\Functional;

use app\controllers\TraderController;
use app\tests\fixtures\TradersFixture;
use app\tests\fixtures\MirotvorecFixture;
use app\tests\fixtures\InfoFixture;

/**
 * Функциональные тесты страниц квестов
 *
 * Class MirotvorecCest
 * @package Tests\Functional
 */
class MirotvorecCest
{
    /**
     * Фикстуры для таблицы mirotvorec
     * @return array
     */
    public function _fixtures() {
        return [
            'traders' => [
                'class' => TradersFixture::class,
                'dataFile' => codecept_data_dir() . 'traders.php'
            ],
            'mirotvorec' => [
                'class' => MirotvorecFixture::class,
                'dataFile' => codecept_data_dir() . 'mirotvorec.php'
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
        $I->amOnRoute(TraderController::routeId(TraderController::ACTION_MIROTVORECPAGE));
    }

    /** Мы видим что все метатеги в head присутствуют и соответствуют нашим стандартам */
    public function checkMetaTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta name="description" content="Прохождение и разбор квестов Миротворца по онлайн-шутеру Escape from Takov.">');
        $I->seeInSource('<meta name="keywords" content="Квесты миротворца в Escape from Tarkov, квесты миротворец Тарков">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="Квесты Миротворца в Escape from Tarkov. Разбор и прохождение квестов Миротворца.">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Квесты Миротворца в Escape from Tarkov. Разбор и прохождение квестов Миротворца.');
    }

    /** Мы видим H1 заголовок и названия квестов а также область контента, что их выводит */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Квесты Миротворца в Escape from Tarkov. Разбор и прохождение квестов Миротворца.', 'h1');
        $I->see('Рыболовные снасти');
        $I->see('Сафари на тигра');
        $I->see('Металлолом');
        $I->seeElement('.quests-content');
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

    /** Проверяем что предупреждающее сообщение миротворца прогрузилось */
    public function checkAlertMessage(\FunctionalTester $I)
    {
        $I->seeElement('.alert.alert-danger.size-16');
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