<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 29.11.2022
 * Time: 18:42
 *
 * Фикстуры боссов для локальной таблицы, чтобы протестировать структуру данных, полученных из API (Unit тестирование)
 * UPD 29-11-2022 - В фикстуру загружен аналогичный PROD набор данных, для максимально приближенной обстановки тестирования
 *
 * Всего тут 9 записей
 */
return [
    [
        'map' => 'Таможня',
        'bosses' => '[{"name":"Death Knight","spawnChance":0.16,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":1}]},{"amount":[{"count":1}]}]},{"name":"Решала","spawnChance":0.1,"spawnTrigger":null,"spawnLocations":[{"name":"Dormitory"},{"name":"GasStation"}],"escorts":[{"amount":[{"count":4}]}]},{"name":"Сектант Жрец","spawnChance":0.02,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":4}]}]}]',
        'date_create' => date("Y-m-d H:i:s"),
        'active' => 1,
        'old' => 0,
        'url' => 'tamojnya'
    ],
    [
        'map' => 'Завод',
        'bosses' => '[{"name":"Тагилла","spawnChance":0.15,"spawnTrigger":null,"spawnLocations":[{"name":"Anywhere"}],"escorts":[]}]',
        'date_create' => date("Y-m-d H:i:s"),
        'active' => 1,
        'old' => 0,
        'url' => 'zavod'
    ],
    [
        'map' => 'Развязка',
        'bosses' => '[{"name":"Килла","spawnChance":0.2,"spawnTrigger":null,"spawnLocations":[{"name":"Center"},{"name":"OLI"},{"name":"IDEA"},{"name":"Goshan"},{"name":"IDEAPark"},{"name":"OLIPark"}],"escorts":[]}]',
        'date_create' => date("Y-m-d H:i:s"),
        'active' => 1,
        'old' => 0,
        'url' => 'razvyazka'
    ],
    [
        'map' => 'Маяк',
        'bosses' => '[{"name":"Death Knight","spawnChance":0.19,"spawnTrigger":null,"spawnLocations":[{"name":"TreatmentContainers"},{"name":"Chalet"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":1}]},{"amount":[{"count":1}]}]},{"name":"Отступник","spawnChance":1,"spawnTrigger":null,"spawnLocations":[{"name":"Blockpost"}],"escorts":[{"amount":[{"count":1}]}]},{"name":"Отступник","spawnChance":1,"spawnTrigger":null,"spawnLocations":[{"name":"RoofContainers"}],"escorts":[{"amount":[{"count":1},{"count":2}]}]},{"name":"Отступник","spawnChance":0.25,"spawnTrigger":null,"spawnLocations":[{"name":"TreatmentRocks"}],"escorts":[{"amount":[{"count":1},{"count":2}]}]},{"name":"Отступник","spawnChance":0.25,"spawnTrigger":null,"spawnLocations":[{"name":"TreatmentBeach"}],"escorts":[{"amount":[{"count":1},{"count":2}]}]},{"name":"Отступник","spawnChance":0.15,"spawnTrigger":null,"spawnLocations":[{"name":"Island"}],"escorts":[{"amount":[{"count":2}]}]},{"name":"Отступник","spawnChance":0.6,"spawnTrigger":null,"spawnLocations":[{"name":"RoofRocks"}],"escorts":[]},{"name":"Отступник","spawnChance":0.6,"spawnTrigger":null,"spawnLocations":[{"name":"RoofBeach"}],"escorts":[{"amount":[{"count":1}]}]},{"name":"Отступник","spawnChance":0.04,"spawnTrigger":null,"spawnLocations":[{"name":"Hellicopter"}],"escorts":[{"amount":[{"count":1},{"count":2}]}]}]',
        'date_create' => date("Y-m-d H:i:s"),
        'active' => 1,
        'old' => 0,
        'url' => 'lighthouse'
    ],
    [
        'map' => 'Ночной Завод',
        'bosses' => '[{"name":"Тагилла","spawnChance":0.15,"spawnTrigger":null,"spawnLocations":[{"name":"Anywhere"}],"escorts":[]},{"name":"Сектант Жрец","spawnChance":0.02,"spawnTrigger":null,"spawnLocations":[{"name":"Anywhere"}],"escorts":[{"amount":[{"count":2}]}]}]',
        'date_create' => date("Y-m-d H:i:s"),
        'active' => 1,
        'old' => 0,
        'url' => 'night-zavod'
    ],
    [
        'map' => 'Резерв',
        'bosses' => '[{"name":"Глухарь","spawnChance":0.2,"spawnTrigger":null,"spawnLocations":[{"name":"RailStrorage"},{"name":"PTOR1"},{"name":"PTOR2"},{"name":"Barrack"},{"name":"SubStorage"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":2}]},{"amount":[{"count":2}]}]},{"name":"Рейдер","spawnChance":0.3,"spawnTrigger":null,"spawnLocations":[{"name":"RailStrorage"}],"escorts":[{"amount":[{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.35,"spawnTrigger":"Bunker Hermetic Door Power Switch","spawnLocations":[{"name":"RailStrorage"}],"escorts":[{"amount":[{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.25,"spawnTrigger":"D-2 Power Switch","spawnLocations":[{"name":"SubCommand"}],"escorts":[{"amount":[{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.15,"spawnTrigger":null,"spawnLocations":[{"name":"SubCommand"}],"escorts":[{"amount":[{"count":2},{"count":3}]}]}]',
        'date_create' => date("Y-m-d H:i:s"),
        'active' => 1,
        'old' => 0,
        'url' => 'rezerv'
    ],
    [
        'map' => 'Берег',
        'bosses' => '[{"name":"Death Knight","spawnChance":0.15,"spawnTrigger":null,"spawnLocations":[{"name":"MeteoStation"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":1}]},{"amount":[{"count":1}]}]},{"name":"Санитар","spawnChance":0.2,"spawnTrigger":null,"spawnLocations":[{"name":"Port"},{"name":"GreenHouses"},{"name":"Sanatorium1"},{"name":"Sanatorium2"}],"escorts":[{"amount":[{"count":2},{"count":3}]}]},{"name":"Сектант Жрец","spawnChance":0.03,"spawnTrigger":null,"spawnLocations":[{"name":"ForestGasStation"},{"name":"ForestSpawn"}],"escorts":[{"amount":[{"count":3}]}]},{"name":"Сектант Жрец","spawnChance":0.03,"spawnTrigger":null,"spawnLocations":[{"name":"Sanatorium1"},{"name":"Sanatorium2"}],"escorts":[{"amount":[{"count":4}]}]}]',
        'date_create' => date("Y-m-d H:i:s"),
        'active' => 1,
        'old' => 0,
        'url' => 'bereg'
    ],
    [
        'map' => 'Лаборатория',
        'bosses' => '[{"name":"Рейдер","spawnChance":0.35,"spawnTrigger":null,"spawnLocations":[{"name":"Floor1"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.35,"spawnTrigger":null,"spawnLocations":[{"name":"Floor2"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.45,"spawnTrigger":null,"spawnLocations":[{"name":"Basement"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.45,"spawnTrigger":null,"spawnLocations":[{"name":"Basement"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.4,"spawnTrigger":null,"spawnLocations":[{"name":"Basement"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.45,"spawnTrigger":null,"spawnLocations":[{"name":"Floor2"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.35,"spawnTrigger":null,"spawnLocations":[{"name":"Floor1"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.3,"spawnTrigger":null,"spawnLocations":[{"name":"Floor2"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.3,"spawnTrigger":null,"spawnLocations":[{"name":"Floor1"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.3,"spawnTrigger":null,"spawnLocations":[{"name":"Floor2"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.35,"spawnTrigger":null,"spawnLocations":[{"name":"Floor1"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.35,"spawnTrigger":null,"spawnLocations":[{"name":"Floor2"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.35,"spawnTrigger":null,"spawnLocations":[{"name":"Floor1"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.35,"spawnTrigger":null,"spawnLocations":[{"name":"Floor2"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.4,"spawnTrigger":null,"spawnLocations":[{"name":"Gate2"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.45,"spawnTrigger":null,"spawnLocations":[{"name":"Gate1"}],"escorts":[{"amount":[{"count":1},{"count":2},{"count":3}]}]}]',
        'date_create' => date("Y-m-d H:i:s"),
        'active' => 1,
        'old' => 0,
        'url' => 'terragroup-laboratory'
    ],
    [
        'map' => 'Лес',
        'bosses' => '[{"name":"Death Knight","spawnChance":0.15,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase2"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":1}]},{"amount":[{"count":1}]}]},{"name":"Сектант Жрец","spawnChance":0.05,"spawnTrigger":null,"spawnLocations":[{"name":"MiniHouse"},{"name":"BrokenVill"}],"escorts":[{"amount":[{"count":4}]}]},{"name":"Штурман","spawnChance":0.2,"spawnTrigger":null,"spawnLocations":[{"name":"WoodCutter"}],"escorts":[{"amount":[{"count":2}]}]}]',
        'date_create' => date("Y-m-d H:i:s"),
        'active' => 1,
        'old' => 0,
        'url' => 'forest'
    ]
];