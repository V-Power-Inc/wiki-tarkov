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
$this->title = 'Карта локации Таможня в Escape from Tarkov - интерактивная карта со спавнами Диких, точками военных ящиков и ключей';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Таможня из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, дверей открываемых ключами.',
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
            <h1 class="map-title">Маркеры</h1>
            <button class="btn btn-danger dikie-b">Спавны диких</button>
            <button class="btn btn-gamers gamers-b">Спавны ЧВК</button>
            <button class="btn btn-bandits bandits-b">Выходы с карты за Диких</button>
            <button class="btn btn-default exits-b">Выходы с карты за ЧВК</button>
            <button class="btn btn-success voenka-b">Военные ящики</button>
            <button class="btn btn-primary polki-b">Офисные ящики</button>
            <button class="btn btn-yellow w-100 keys-b">Отпираемые двери</button>
            <button class="btn btn-places w-100 places-b">Интересные места</button>
        </div>
        <!-- Контент страницы -->
        <div class="col-lg-12">
            <!-- Маркеры выходов в зависимости от спавна -->
            <div class="random-exits">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary remastered station-spawn active">
                        <input type="radio" name="options" id="option2" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                        <span>Выходы для спавна Старая станция</span>
                    </label>

                    <br>
                    <br>

                    <label class="btn btn-primary house-spawn remastered">
                        <input type="radio" name="options" id="option1" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                        <span>Выходы для спавна Дом</span>
                    </label>
                </div>
                <br>
                <br>
            </div>

            <div class="static-description">
                <h2>Интерактивная карта Таможни</h2>
                <p>Интерактивная карта локации Таможня со спавнами ЧВК с обоих сторон локации, маркеры Диких, военных ящиков а также указания где найти ценные ключи от дверей и сейфов.</p>
                <p>Нажимая на любой маркер, вы сможете увидеть уточняющую информацию о нем, при нажатии на спавны диких, вы узнаете как они ведут себя в определенных ситуациях и в каких количествах могут спавниться.</p>
                <p>Нажимая на меркеры ключей - вы сможете узнать какие ключи нужны вам для открытия дверей - <u>ключи можно найти на трупах диких, в офисных полках и одежде</u>.</p>
                <p class="alert alert-info"><b>Ключ от выхода с завода</b> также спавнится в 3х этажном общежитии на Таможне на 1 этаже на столе слева от телевизора в помещении консержки.</p>
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