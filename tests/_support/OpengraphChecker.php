<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.03.2024
 * Time: 18:53
 */

namespace tests\_support;

/**
 * Класс по проверке OpenGraph тегов в Head секции сайта
 * Вспомогательный класс помощник, чтобы сократить количество кода внутри самих тестов
 *
 * Используется функциональными тестами
 *
 * Class OpengraphChecker
 * @package tests\_support
 */
final class OpengraphChecker
{
    /**
     * @param \FunctionalTester $I
     * @param string $title - Заголовок для OG Title
     * @return void
     */
    public static function checkTags(\FunctionalTester $I, string $title)
    {
        /** Проверяем OpenGraph тип ресурса в тегах */
        $I->seeInSource('<meta property="og:type" content="website">');

        /** Проверяем OpenGraph имя сайта в тегах */
        $I->seeInSource('<meta property="og:site_name" content="База знаний Escape from Tarkov">');

        /** Проверяем OpenGraph заголовок в тегах */
        $I->seeInSource('<meta property="og:title" content="' . $title . '">');

        /** Проверяем OpenGraph изображение в тегах */
        $I->seeInSource('<meta property="og:image" content="/img/logo-full.png">');
    }
}