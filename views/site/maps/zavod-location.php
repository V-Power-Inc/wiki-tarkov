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
$this->title = 'Карта локации Завод в Escape from Tarkov - интерактивная карта Завода с маркерами';
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
                <h1 class="map-title">Маркеры</h1>
                <button class="btn btn-success voenka-b">Военные ящики</button>
                <button class="btn btn-danger dikie-b">Спавны диких</button>
                <button class="btn btn-gamers gamers-b">Спавны ЧВК</button>
                <button class="btn btn-primary polki-b">Офисные ящики</button>
                <button class="btn btn-default exits-b">Выходы с карты</button>
                <button class="btn btn-yellow w-100 keys-b">Отпираемые двери</button>
            </div>
            <!-- Контент страницы -->
            <div class="col-lg-12">
                <div class="static-description">
                    <h2>Интерактивная карта Завода</h2>
                    <p>На этой странице представлена интерактивная карта локации завод из игры Escape from Tarkov с маркерами спавнов диких, игроков ЧВК а также месторасположения военных ящиков, выходов с локации, дверей открываемых ключами и офисных ящиков.</p>
                    <p>Нажимая на любой маркер, вы сможете увидеть уточняющую информацию о нем, при нажатии на спавны диких, вы узнаете как они ведут себя в определенных ситуациях.</p>
                    <p>Нажимая на меркеры ключей - вы сможете узнать какие ключи нужны вам для открытия дверей - ключи можно найти на трупах диких, в офисных полках и одежде.</p>
                    <p class="alert alert-info"><b>Ключ от выхода с завода</b> также спавнится в 3х этажном общежитии на Таможне на 1 этаже на столе слева от телевизора в помещении консержки.</p>
                    <p></p>
                </div>
                <div id="voenniymarker"></div>
                <div id="polkiimarker"></div>
                <div id="dikiymarker"></div>
                <div id="exitsmarker"></div>
                <div id="keysmarker"></div>
                <div id="playermarker"></div>
            </div>
        </div>
    </div>







