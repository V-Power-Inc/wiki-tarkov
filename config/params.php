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
 * recapchaKey - Ключ от капчи, без него, весь функционал связанный с капчей работать не будет
 *
 * recapchaSiteKey - Ключ от капчи, без него, весь функционал связанный с капчей работать не будет
 *
 * restrictedAlertsUrls - список урлов, на которых не выводится компонент AlertComponent а также заголовок с H1 (
 * В таких урлах это реализовано отдельно)
 *
 * cacheTime - массив со временем кеширования (Ключ название - значение количество в секундах)
 *
 * discordHookNewsUrl - URL веб хука для дискорда
 */

return [
    'adminEmail' => '#',
    'discordCache' => 1,
    'yandexCache' => 1,
    'keysBlocks' => [],

    'recapchaKey' => '6LcNnTggAAAAAKiDSyRe0BisZPZqFqtPdRu1LCum',
    'recapchaSiteKey' => '6LcNnTggAAAAAEK6rB1IcEZSdhVQyl_X5gEDNnxF',


    'restrictedAlertsUrls' => [
        '/',
        '/maps/zavod-location',
        '/maps/forest-location',
        '/maps/tamojnya-location',
        '/maps/bereg-location',
        '/maps/razvyazka-location',
        '/maps/terragroup-laboratory-location',
        '/maps/rezerv-location',
        '/maps/lighthouse-location',
        '/maps/streets-of-tarkov-location'
    ],
    'cacheTime' => [
        'one_hour' => 3600,
        'seven_days' => 604800,
        'one_day' => 86400
    ],
    'discordHookNewsUrl' => 'https://discord.com/api/webhooks/452407880566571008/XUNKYU2VjqAyjx3TW5eCw8vOrzYaohxo4Ym6T025R0hFZ2vwcmr2n0Np9vo88mE_8xSO'
];