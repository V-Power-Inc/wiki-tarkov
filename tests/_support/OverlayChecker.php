<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.03.2024
 * Time: 18:41
 */

namespace tests\_support;

/**
 * Класс по проверке оверлея
 * Вспомогательный класс помощник, чтобы сократить количество кода внутри самих тестов
 *
 * Используется функциональными тестами
 *
 * Class OverlayChecker
 * @package tests\_support
 */
final class OverlayChecker
{
    /**
     * Проверяем кликабельность кнопки, которая скроет рекламный блок оверлей
     *
     * @param \FunctionalTester $I
     * @return void
     */
    public static function overlayIsCloseIsClickable(\FunctionalTester $I)
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