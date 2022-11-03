<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 14:00
 */

namespace app\common\services;

/**
 * Сервис для получения транслитов для всякого рода потребностей
 *
 * Class TranslateService
 * @package app\common\services
 */
final class TranslateService
{
    /**
     * Метод по полученному параметру создает название карты - возвращает строку
     * Если вхождения не было - вернет null
     *
     * @param string $map - название карты
     * @return string|null
     */
    public static function mapUrlCreator(string $map): string
    {
        /** В свитче перебираем все известные названия карт и возвращаем транслит в виде строки */
        switch ($map) {
            case 'Таможня':
                return 'tamojnya';
            case 'Завод':
                return 'zavod';
            case 'Развязка':
                return 'razvyazka';
            case 'Маяк':
                return 'lighthouse';
            case 'Резерв':
                return 'rezerv';
            case 'Ночной Завод':
                return 'night-zavod';
            case 'Берег':
                return 'bereg';
            case 'Лаборатория':
                return 'terragroup-laboratory';
            case 'Лес':
                return 'forest';
        }

        /** Возвращаем null только если не попали не в 1 из кейсов */
        return null;
    }
}