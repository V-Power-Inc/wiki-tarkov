<?php

namespace app\common\services;

/**
 * Промежуточный класс сервиса по работе с API данными
 * Class AbstractItemsApiService
 * @package app\common\services
 */
abstract class AbstractItemsApiService implements CommonServiceInterface
{
    /**
     * Заглушка для API предметов с невалидным урлом (Проблемные предметы из API)
     * @param string $itemUrl - url предмета
     * @param string $finalString - заглушка img
     * @return string
     */
    public static function setupImageWithCheckingUrl(string $itemUrl, string $finalString): string
    {
        return (in_array($itemUrl, explode(',', $_ENV['PROBLEM_URLS'])) === true)
            ? $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . '/img/qsch6455.png' # declined
            : $finalString;
    }

    /**
     * Заглушка для API предметов с невалидным названием (Проблемные предметы из API)
     * @param string $itemName - название предмета
     * @param string $finalString - заглушка img
     * @return string
     */
    public static function setupImageWithCheckingName(string $itemName, string $finalString): string
    {
        return (in_array(str_replace(' ', '', $itemName), explode(',', $_ENV['PROBLEM_NAMES'])) === true)
            ? $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . '/img/qsch6455.png' # declined
            : $finalString;
    }

    /**
     * Метод возвращает название категории или базовую строку заглушку, если название категории не получено
     * @param string|null $categoryName
     * @return string
     */
    public static function getCategoryName(?string $categoryName): string
    {
        return is_string($categoryName) ? $categoryName : 'Не определена';
    }

    /**
     * Метод проверяет, является ли URL адрес проблемным
     * @param string $itemUrl
     * @return bool
     */
    protected function isTroubleUrl(string $itemUrl): bool
    {
        return in_array($itemUrl, explode(',', $_ENV['PROBLEM_URLS']));
    }
}