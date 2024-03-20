<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 20.03.2024
 * Time: 13:17
 *
 * Конфиг с параметрами для тестов
 */

return [
    'adminEmail' => '#',
    'yandexCache' => 1,
    'keysBlocks' => [],

    'recapchaKey' => 'empty_key',
    'recapchaSiteKey' => 'empty_key',

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
        '/maps/streets-of-tarkov-location',
        '/maps/epicenter'
    ],
    'cacheTime' => [
        'one_minute' => 60,
        'one_hour' => 3600,
        'seven_days' => 604800,
        'one_day' => 86400
    ],
];