<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.12.2023
 * Time: 21:57
 */

namespace Tests\Functional;

use app\tests\fixtures\CatskillsFixture;
use app\tests\fixtures\SkillsFixture;
use tests\_support\CheckLinks;
use tests\_support\CheckPageCodes;
use tests\_support\OverlayChecker;

/**
 * Функциональные тестирование страницы-категории справочника умений
 *
 * Class CatSkillsCategoryCest
 * @package Tests\Functional
 */
class CatSkillsCategoryCest
{
    /** Метод выполняется перед каждым тестом */
    public function _before(\FunctionalTester $I)
    {
        /** Грузим фикстуры перед каждым тестом */
        $I->haveFixtures([
            'catskills' => [
                'class' => CatskillsFixture::class,
                'dataFile' => codecept_data_dir() . 'catskills.php'
            ],
            'skills' => [
                'class' => SkillsFixture::class,
                'dataFile' => codecept_data_dir() . 'skills.php'
            ],
        ]);

        /** Мы на главной странице категории умений (Тут какой-то косяк с урлом) */
        $I->amOnRoute( '/skills/physical');
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
        $I->seeInSource('<meta name="description" content="Физические умения в Таркове влияют на выносливость, метаболизм и здоровье а также повышает шансы на выживание в бою.">');
        $I->seeInSource('<meta name="keywords" content="Физические умения Escape from Tarkov">');
    }

    /** Мы видим что все OpenGraph теги соответствуют нашим стандартам */
    public function checkOpengraphTagsData(\FunctionalTester $I)
    {
        $I->seeInSource('<meta property="og:type" content="website">');
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');
        $I->seeInSource('<meta property="og:title" content="Escape from Tarkov: Физические умения">');
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }

    /** Мы видим корректный Title */
    public function checkTitle(\FunctionalTester $I)
    {
        $I->seeInTitle('Escape from Tarkov: Физические умения');
    }

    /** Мы видим H1 заголовок */
    public function checkPageMainData(\FunctionalTester $I)
    {
        $I->see('Escape from Tarkov: Физические умения', 'h1');
    }

    /** Мы видим что основное описание страницы присутствует на ней */
    public function checkPageContentDescription(\FunctionalTester $I)
    {
        $I->seeElement('.alert.alert-info.size-16');
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

    /** Проверяем наличие связанных записей на странице */
    public function checkItemsOnPage(\FunctionalTester $I)
    {
        /** Пожелания */
        $I->wantTo('Увидеть связанные умения категории');

        /** Видим предмет из справочника умений, привязанный к этой категории */
        $I->seeLink('Выносливость', '/skills/physical/endurance.html');

        /** Видим предмет из справочника умений, привязанный к этой категории */
        $I->seeLink('Сила', '/skills/physical/strengh.html');
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