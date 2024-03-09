<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 25.08.2022
 * Time: 13:23
 */

namespace Tests\Functional;

use app\tests\fixtures\TradersFixture;
use tests\_support\CheckLinks;
use tests\_support\CheckPageCodes;
use tests\_support\OverlayChecker;

/**
 * Функциональные тесты страницы детальных торговцев
 *
 * Class PraporpageCest
 * @package Tests\Functional
 */
class TraderCest
{
    /** Метод выполняется перед каждым тестом */
    public function _before(\FunctionalTester $I)
    {
        /** Грузим фикстуры перед каждым тестом */
        $I->haveFixtures([
            'traders' => [
                'class' => TradersFixture::class,
                'dataFile' => codecept_data_dir() . 'traders.php'
            ]
        ]);

        /** Мы на главной странице */
        $I->amOnRoute('traders/prapor');
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
        /** Проверяем ссылки горизонтальной навигации на корректность */
        CheckLinks::onMenu($I);
    }

    /** Проверяем активность пункта навигации, для текущей страницы */
    public function checkCurrentPageLinkActive(\FunctionalTester $I)
    {
        $I->seeElement('.dropdown-toggle.active');
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