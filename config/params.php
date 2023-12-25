<?php

/**
 * Параметры приложения
 *
 * adminEmail - Email администратора
 *
 * yandexCache - флаг для кеширования яндекса
 *
 * keysBlocks - флаг для генерации рекламного места, в циклах материалов
 *
 * recapchaKey - Ключ от капчи, без него, весь функционал связанный с капчей работать не будет (Выводится из переменной окружения)
 *
 * recapchaSiteKey - Ключ от капчи, без него, весь функционал связанный с капчей работать не будет  (Выводится из переменной окружения)
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
    'yandexCache' => 1,
    'keysBlocks' => [],

    'recapchaKey' => !empty($_ENV['RECAPCHAKEY']) ? $_ENV['RECAPCHAKEY'] : 'empty_key',
    'recapchaSiteKey' => !empty($_ENV['RECAPCHASITEKEY']) ? $_ENV['RECAPCHASITEKEY'] : 'empty_key',

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
        'one_minute' => 60,
        'one_hour' => 3600,
        'seven_days' => 604800,
        'one_day' => 86400
    ],
    'discordHookNewsUrl' => 'your_discord_hook'
];