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
     * Заглушка для API предметов с невалидным урлом
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

    public static function setupImageWithCheckingName(string $itemName, string $finalString): string
    {
        return (in_array(str_replace(' ', '', $itemName), explode(',', $_ENV['PROBLEM_NAMES'])) === true)
            ? $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . '/img/qsch6455.png' # declined
            : $finalString;
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