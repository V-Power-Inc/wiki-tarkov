<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 23.01.2018
 * Time: 21:43
 */

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/tamojnya-location.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Карта локации Таможня в Escape from Tarkov - интерактивная карта с выходами Диких';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Таможня из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, выходов с локации за Диких.',
]);
?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации Таможня</h1>
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
<!-- Опции карты -->
<div class="optins_layerstability">
    <div class="outer-button"><img src="/img/maps/button_outer.png"></div>
    <div class="inner-button"><img src="/img/maps/button_inner.png"></div>
    <div class="col-lg-12">
        <div class="option-buttons">
            <h2 class="map-title">Маркеры</h2>
            <button class="btn btn-danger dikie-b">Спавны диких</button>
            <button class="btn btn-gamers gamers-b">Спавны ЧВК</button>
            <button class="btn btn-bandits bandits-b">Выходы с карты за Диких</button>
            <button class="btn btn-default exits-b">Выходы с карты за ЧВК</button>
            <button class="btn btn-success voenka-b">Оружейные ящики</button>
            <button class="btn btn-primary polki-b">Квестовые точки</button>
            <button class="btn btn-yellow w-100 keys-b">Открываемые двери</button>
            <button class="btn btn-places w-100 places-b">Интересные места</button>
        </div>
        <!-- Контент страницы -->
        <div class="col-lg-12">
            <!-- Маркеры выходов в зависимости от спавна -->
            <div class="random-exits">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary house-spawn remastered active">
                        <input type="radio" name="options" id="option1" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                        <span>Выходы для спавна Таможня</span>
                    </label>
                    
                    <br>
                    <br>

                    <label class="btn btn-primary remastered station-spawn">
                        <input type="radio" name="options" id="option2" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                        <span>Выходы для спавна Бойлеры</span>
                    </label>

                </div>
                <br>
                <br>
            </div>

            
            
            <div class="static-description">
                <h2>Интерактивная карта Таможни</h2>
                <p>Интерактивная карта локации Таможня из Escape from Tarkov - на данной карте, вы сможете увидеть выходы за диких и ЧВК с локации Таможня, узнать о местонахождении оружейных и военных ящиков, а также многое другое. </p>
                <p>Также с помощью интерактивной карты вы сможете узнать о местах спавна ключей от помещений и сейфов, которые спавнятся на карте Таможня с определенной вероятностью, производственного лута и квестовых предметов необходимых для прохождения заданий от торговцев. Интерактивная карта локации Таможня поможет вам очень быстро найти квестовые точки, на которых можно увидеть предметы, или места необходимые для выполнения квестов торговцев.</p>
                <p>Есть возможность узнать спавны ЧВК и Диких на карте Таможня, с картинками их месторасположений, а также комментариями о различных особенностях этих спавнов. </p>
            </div>
            <div id="voenniymarker"></div>
            <div id="polkiimarker"></div>
            <div id="dikiymarker"></div>
            <div id="exitsmarker"></div>
            <div id="keysmarker"></div>
            <div id="playermarker"></div>
            <div id="dikiyexitmarker"></div>
            <div id="necessaryplaces"></div>

           
        </div>
    </div>
</div>