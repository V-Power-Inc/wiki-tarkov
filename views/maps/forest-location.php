<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.12.2017
 * Time: 18:23
 */

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/map_hash.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/forest-location.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->title = 'Карта локации Лес в Escape from Tarkov - интерактивная карта со спавнами Диких, точками военных ящиков и ключей';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Лес из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, дверей открываемых ключами.',
]);
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации Лес</h1>
    </div>
</div>

<!-- Инициализация карты -->
<div class="w-100">
    <div id="map" class="map">
        <!-- Координаты мышки -->
        <div id="mapCoords" data-original-title="" title=""></div>
        <!-- Кнопка вернуться к центру -->
        <p class="mapcenter"><a class="btn btn-default main-link">Вернуться к центру карты</a></p>
    </div>
</div>