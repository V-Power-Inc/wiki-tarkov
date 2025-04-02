<?php

namespace app\common\services;

/**
 * Промежуточный класс сервиса по работе с API данными
 * Class AbstractItemsApiService
 * @package app\common\services
 */
abstract class AbstractItemsApiService implements CommonServiceInterface
{
    public static function setupImageWithCheckingUrl(string $itemUrl, string $finalString): string
    {
        return (in_array($itemUrl, explode(',', $_ENV['PROBLEM_URLS'])) === true)
            ? $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . '/img/qsch.png'
            : $finalString;
    }

    public static function setupImageWithCheckingName(string $itemName, string $finalString): string
    {
        return (in_array($itemName, explode(',', $_ENV['PROBLEM_NAMES'])) === true)
            ? $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . '/img/qsch.png'
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