<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 02.01.2023
 * Time: 15:13
 *
 * Страница с интерактивной картой локации Улицы Таркова
 */

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/map_hash.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/streets-of-tarkov-location.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->title = 'Карта локации Улицы Таркова';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Улицы Таркова из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, дверей открываемых ключами.',
]);
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации Улицы Таркова</h1>
    </div>
</div>

<!-- Инициализация карты -->
<div class="w-100">
    <div id="map" class="map relative">

        <!-- Координаты мышки -->
        <div id="mapCoords" data-original-title="" title=""></div>

        <!-- Кнопка вернуться к центру -->
        <p class="mapcenter"><a class="btn btn-default main-link">Вернуться к центру карты</a></p>
    </div>
</div>