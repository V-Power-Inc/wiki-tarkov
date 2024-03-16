<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.03.2024
 * Time: 2:08
 */

namespace tests\_support;

/**
 * Класс с методами для тестирования CRUD через функциональное тестирование
 *
 * Class CheckCrud
 * @package tests\_support
 */
final class CheckCrud
{
    /**
     * Проверяем что страница создания записей в админке работает корректно
     *
     * @param \FunctionalTester $I
     * @param string $url - URL адрес для тестирования
     * @return void
     */
    public static function onCreate(\FunctionalTester $I, string $url)
    {
        /** Проверяем что страница с кодом 200 и есть h1 заголовок */
        self::baseChecking($I, $url);

        /** Видим форму создания новой записи */
        $I->canSeeElement('form');

        /** Видим кнопку создания новой записи */
        $I->canSeeElement('.btn-success');

        /** Видим кнопку возврата в список всех записей */
        $I->canSeeElement('.btn-primary');
    }

    /**
     * Проверяем что страница просмотра записей в админке работает корректно
     *
     * @param \FunctionalTester $I
     * @param string $url - URL адрес для тестирования
     * @return void
     */
    public static function onView(\FunctionalTester $I, string $url)
    {
        /** Проверяем что страница с кодом 200 и есть h1 заголовок */
        self::baseChecking($I, $url);

        /** Можем видеть таблицу с данными */
        $I->canSeeElement('table');

        /** Видим кнопки возврата в список всех записей и обновления */
        $I->canSeeElement('.btn-primary');

        /** Видим кнопку удаления записи */
        $I->canSeeElement('.btn-danger');
    }

    /**
     * Проверяем что страница редактирования записей работает корректно
     *
     * @param \FunctionalTester $I
     * @param string $url - URL адрес для тестирования
     * @return void
     */
    public static function onEdit(\FunctionalTester $I, string $url)
    {
        /** Проверяем что страница с кодом 200 и есть h1 заголовок */
        self::baseChecking($I, $url);

        /** Видим форму создания новой записи */
        $I->canSeeElement('form');

        /** Видим кнопку возврата в список всех записей */
        $I->canSeeElement('.btn-primary');
    }

    /**
     * Проверяем что страница удаления записей возвращает 405 код (Только через POST запрос можно удалить запись)
     *
     * @param \FunctionalTester $I
     * @param string $url - URL адрес для тестирования
     * @return void
     */
    public static function onDelete(\FunctionalTester $I, string $url)
    {
        /** Заходим на страницу URL'a */
        $I->amOnRoute($url);

        /** Убедимся что код ошибки 405 */
        CheckPageCodes::checkMethodNotAllowed($I);
    }

    /**
     * Метод с повторяющимися проверками, для остальных методов текущего класса
     *
     * @param \FunctionalTester $I
     * @param string $url - URL адрес, что проверяем
     * @return void
     */
    private static function baseChecking(\FunctionalTester $I, string $url)
    {
        /** Заходим на страницу URL'a */
        $I->amOnRoute($url);

        /** Проверяем что ответ сервера - 200 */
        CheckPageCodes::start($I);

        /** Проверяем, что есть заголовок H1 */
        $I->canSeeElement('h1');

        /** Видим футер */
        $I->canSeeElement('footer');

        /** Видим корректное название организации в футере */
        $I->canSee('V-Power', 'a');
    }
}