<?php

/**
 * Параметры приложения
 *
 * adminEmail - Email администратора
 *
 * discordCache - флаг для кеширования виджета дискорда
 *
 * yandexCache - флаг для кеширования яндекса
 *
 * keysBlocks - флаг для генерации рекламного места, в циклах материалов
 *
 * restrictedAlertsUrls - список урлов, на которых не выводится компонент AlertComponent а также заголовок с H1 (
 * В таких урлах это реализовано отдельно)
 *
 *
 */

return [
    'adminEmail' => '#',
    'discordCache' => 1,
    'yandexCache' => 1,
    'keysBlocks' => [8],
    'restrictedAlertsUrls' => [
        '/',
        '/maps/zavod-location',
        '/maps/forest-location',
        '/maps/tamojnya-location',
        '/maps/bereg-location',
        '/maps/razvyazka-location',
        '/maps/terragroup-laboratory-location',
        '/maps/rezerv-location',
        '/maps/lighthouse-location'
    ]
];
