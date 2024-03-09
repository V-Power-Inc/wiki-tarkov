<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.03.2024
 * Time: 18:31
 */

namespace tests\_support;

/**
 * Класс по проверке кодов ответов страниц
 * Вспомогательный класс помощник, чтобы сократить количество кода внутри самих тестов
 *
 * Используется функциональными тестами
 *
 * Class CheckPageCodes
 * @package tests\_support
 */
final class CheckPageCodes
{
    /**
     * Проверяем что код страницы именно 200 (Все в порядке)
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public static function start(\FunctionalTester $I)
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
}