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
$this->title = 'Карта локации Завод в Escape from Tarkov - интерактивная карта со спавнами Диких, точками военных ящиков и ключей';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Завод из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, дверей открываемых ключами.',
]);
?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации Завод</h1>
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
                <button class="btn btn-success voenka-b">Военные ящики</button>
                <button class="btn btn-primary polki-b">Квестовые точки</button>
                <button class="btn btn-yellow w-100 keys-b">Отпираемые двери</button>
                <button class="btn btn-places w-100 places-b">Интересные места</button>
            </div>
            <!-- Контент страницы -->
            <div class="col-lg-12">
                <div class="static-description">
                    <h2>Интерактивная карта Завода</h2>
                    <p>На этой странице представлена интерактивная карта локации Завод из игры Escape from Tarkov с маркерами спавнов диких, игроков ЧВК а также месторасположения военных ящиков, выходов с локации, дверей открываемых ключами и офисных ящиков.</p>
                    <p>Нажимая на любой маркер, вы сможете увидеть уточняющую информацию о нем, при нажатии на спавны диких, вы узнаете как они ведут себя в определенных ситуациях.</p>
                    <p>Нажимая на маркеры ключей - вы сможете узнать какие ключи нужны вам для открытия дверей - <u>ключи можно найти на трупах диких, в офисных полках и одежде</u>.</p>
                    <p class="alert alert-info">Информацию о спавне <b>ключа от Выхода с Завода</b> и открываемым этим ключом дверям вы <b><a href="/keys/key-of-exit-zavod" style="color: #d9534f;" target="_blank">сможете найти в нашей статье.</a></b> </p>
                    <p></p>
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







