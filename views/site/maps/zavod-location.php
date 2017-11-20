<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 26.10.2017
 * Time: 15:05
 */
$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/zavod-location.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Карта локации Завод в Escape from Tarkov - интерактивная карта Завода с просмотром ключей от помещений';
?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class">
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

    <div id="map" class="map">

    </div>
    <!-- Опции карты -->
    <div class="optins_layerstability">
    
    </div>

    <!-- Координаты мышки -->
    <div id="mapCoords" data-original-title="" title=""></div>





