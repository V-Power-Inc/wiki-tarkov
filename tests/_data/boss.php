<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 30.11.2022
 * Time: 10:46
 *
 * Фикстура с боссами Резерва, для функционального тестирования детальных страниц боссов
 */
return [
    'id' => 10,
    'map' => 'Резерв',
    'bosses' => '[{"name":"Глухарь","spawnChance":0.2,"spawnTrigger":null,"spawnLocations":[{"name":"RailStrorage"},{"name":"PTOR1"},{"name":"PTOR2"},{"name":"Barrack"},{"name":"SubStorage"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":2}]},{"amount":[{"count":2}]}]},{"name":"Рейдер","spawnChance":0.3,"spawnTrigger":null,"spawnLocations":[{"name":"RailStrorage"}],"escorts":[{"amount":[{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.35,"spawnTrigger":"Bunker Hermetic Door Power Switch","spawnLocations":[{"name":"RailStrorage"}],"escorts":[{"amount":[{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.25,"spawnTrigger":"D-2 Power Switch","spawnLocations":[{"name":"SubCommand"}],"escorts":[{"amount":[{"count":2},{"count":3}]}]},{"name":"Рейдер","spawnChance":0.15,"spawnTrigger":null,"spawnLocations":[{"name":"SubCommand"}],"escorts":[{"amount":[{"count":2},{"count":3}]}]}]',
    'date_create' => date("Y-m-d H:i:s"),
    'active' => 1,
    'old' => 0,
    'url' => 'rezerv'
];