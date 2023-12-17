<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.12.2023
 * Time: 21:22
 */

namespace Tests\Functional;

use app\controllers\LootController;
use app\tests\fixtures\CategoryFixture;
use app\tests\fixtures\ItemsFixture;
use yii\helpers\Url;

/**
 * Функциональные тесты страницы категории справочника луту
 *
 * Class CategoryLootPageCest
 * @package Tests\Functional
 */
class CategoryLootPageCest
{
    /** Метод выполняется перед каждым тестом */
    public function _before(\FunctionalTester $I)
    {
        /** Грузим фикстуры перед каждым тестом */
        $I->haveFixtures([
            'category' => [
                'class' => CategoryFixture::class,
                'dataFile' => codecept_data_dir() . 'category.php'
            ],
            'items' => [
                'class' => ItemsFixture::class,
                'dataFile' => codecept_data_dir() . 'items.php'
            ]
        ]);

        /** Мы на категории справочника лута */
        $I->amOnRoute(LootController::routeId(LootController::ACTION_CATEGORY) . '/main-category');
    }

    /** Мы проверяем - что код страницы 200 */
    public function checkCodeIsOk(\FunctionalTester $I)
    {
        /** Ожидание */
        $I->wantTo('Получить страницу с кодом 200');

        /** Вижу что код ответа не 404 */
        $I->cantSeeResponseCodeIs(404);

        /** Вижу что код ответа не 500 */
        $I->cantSeeResponseCodeIs(500);

        /** Вижу корректный код - 200 */
        $I->canSeeResponseCodeIs(200);
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
        $I->seeInSource('<meta name="description" content="Seo описание новой основной категории">');
        $I->seeInSource('<meta name="keywords" content="Основная категория, лут, тесты">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="Escape from Tarkov: Основная категория">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Escape from Tarkov: Основная категория');
    }

    /** Мы видим левое меню, с категориями справочника лута */
    public function checkLeftMenuExists(\FunctionalTester $I)
    {
        $I->seeElement('#categories-menu');
    }

    public function checkCategoriesExists(\FunctionalTester $I)
    {
        $I->seeLink('Основная категория', '/loot/main-category');
        $I->seeLink('Основная категория - second', '/loot/main-category-second');
    }

    /** Мы видим H1 заголовок и кнопку перейти к интерактивным картам */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Escape from Tarkov: Основная категория', 'h1');
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
        $I->seeElement('.alert.alert-info.size-16');
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

    /** Проверяем наличие связанных записей на странице */
    public function checkItemsOnPage(\FunctionalTester $I)
    {
        /** Пожелания */
        $I->wantTo('Увидеть предмет из справочника лута, привязанный к этой категории');

        /** Видим предмет из справочника лута, привязанный к этой категории */
        $I->seeLink('Снайперская винтовка СВ-98', '/loot/sv-98.html');
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
        /** Видим что футер присутствует */
        $I->SeeElement('footer');

        /** Видим что копирайт есть в футере */
        $I->SeeElement('footer p.copyright.text-center');

        /** Видим что присутствует название организации */
        $I->SeeElement('footer p.copyright.text-center span.organization_footer_title');

        /** Видим что присутствуют иконки-ссылки на соц-сети */
        $I->SeeElement('div.icons-soc');

        /** Видим что присутствует email обратной связи */
        $I->see('Контактный Email: ', 'footer p.contact-info');

        /** Видим что в футере указано, кому принадлежат права */
        $I->see( 'Все права на Escape from Tarkov принадлежат Battlestate Games Limited','footer p.marks');
    }
}