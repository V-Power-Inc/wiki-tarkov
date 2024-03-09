<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.03.2024
 * Time: 17:08
 */

namespace tests\_support;

/**
 * Класс по проверке ссылок в футере сайта
 * Вспомогательный класс помощник, чтобы сократить количество кода внутри самих тестов
 *
 * Используется функциональными тестами
 *
 * Class CheckFooterLinksCest
 * @package Tests\Functional
 */
class CheckLinks
{
    /**
     * Метод проверяет - все ли ссылки горизонтального меню присутствуют на страницах
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public static function onMenu(\FunctionalTester $I)
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
        $I->seeLink('Эпицентр', '/maps/epicenter#2/48.7/-24.8');
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

    /**
     * Метод проверяет корректность ссылок в подвале на страницах сайта
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public static function onFooter(\FunctionalTester $I)
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