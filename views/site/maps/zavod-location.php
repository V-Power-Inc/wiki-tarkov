<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 26.10.2017
 * Time: 15:05
 */
use app\models\Zavod;

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/zavod-location.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Карта локации Завод в Escape from Tarkov - интерактивная карта Завода с просмотром ключей от помещений';
?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации завод</h1>
    </div>
</div>

<!--<div class="right__content">-->
<!--    <div class="col-lg-12">-->
<!--        <h2 class="white">title - Заголовок</h2>-->
<!--        <p></p>-->
<!--    </div>-->
<!--</div>-->


    <!-- Инициализация карты -->
<div class="w-77">
    <div id="map" class="map">
        <!-- Координаты мышки -->
        <div id="mapCoords" data-original-title="" title=""></div>
    </div>
</div>
    <!-- Опции карты -->
    <div class="optins_layerstability">
        <div class="col-lg-12">
            <div class="option-buttons">
                <h1 class="map-title">Маркеры</h1>
                <button class="btn btn-success voenka-b">Военные ящики</button>
                <button class="btn btn-danger dikie-b">Спавны диких</button>
                <button class="btn btn-primary seifs-b">Сейфы и полки</button>
                <button class="btn btn-default exits-b">Выходы с карты</button>
                <button class="btn btn-yellow w-100 keys-b">Двери и ключи от них</button>
            </div>
            <!-- Контент страницы -->
            <div class="col-lg-12">
                <div id="voenniymarker">
                </div>
                <div id="polkiimarker"></div>
                <div id="dikiymarker"></div>
                <div id="exitsmarker"></div>
                <div id="keysmarker"></div>
            </div>
        </div>
    </div>







