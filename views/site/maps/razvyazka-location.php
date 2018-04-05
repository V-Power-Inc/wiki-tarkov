<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 05.04.2018
 * Time: 15:00
 */

// $this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
// $this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
// $this->registerJsFile('js/map_hash.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
// $this->registerJsFile('js/razvyazka-location.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Карта локации Развязка в Escape from Tarkov - интерактивная карта со спавнами Диких, точками военных ящиков и ключей';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Развязка из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, дверей открываемых ключами.',
]);
?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации Развязка</h1>
    </div>
</div>

<!-- Инициализация карты -->
<div class="w-100">
    <!-- todo: Убрать ручные стили после релиза -->
    <div id="map" class="map relative" style="background: #e7dfdd; margin-top: -10px;">
        
        <!-- NetCat div block -->
        <div style="width:400px; height:300px; position:absolute;top:50%;left:50%;margin:-200px 0 0 -150px;">
            <img src="/img/netcat.gif">
        </div>
        
        <!-- Координаты мышки -->
        <div id="mapCoords" data-original-title="" title=""></div>
        <!-- Кнопка вернуться к центру -->
        <!-- todo: Убрать disavled класс после релиза -->
        <p class="mapcenter"><a class="btn btn-default main-link disabled">Вернуться к центру карты</a></p>
    </div>
</div>

<!-- Опции карты -->
<div class="optins_layerstability">
    
    <!-- todo: Убрать это после релиза -->
    <div style="display:none;">
        <div class="outer-button"><img src="/img/maps/button_outer.png"></div>
        <div class="inner-button"><img src="/img/maps/button_inner.png"></div>
    </div>
    
    
    <div class="col-lg-12">
        <div class="option-buttons">
            <h2 class="map-title">Маркеры</h2>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                    <p class="dikie-b" id="dikie-spawns-bereg"><i class="dikie-spawns"></i>Спавны диких</p>
                    <p class="gamers-b" id="chvk-spawns-bereg"><i class="chvk-spawns"></i>Спавны ЧВК</p>
                    <p class="bandits-b" id="dikie-exits-bereg"><i class="dikie-exits"></i>Выходы с карты за Диких</p>
                    <p class="exits-b" id="chvk-exits-bereg"><i class="chvk-exits"></i>Выходы с карты за ЧВК</p>
                </div>
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                    <p class="voenka-b" id="weapons-bereg"><i class="weapon-cases"></i>Оружейные ящики</p>
                    <p class="polki-b" id="quests-bereg"><i class="quest-tochki"></i>Квестовые точки</p>
                    <p class="w-100 keys-b" id="doors-bereg"><i class="doors-tochki"></i>Открываемые двери</p>
                    <p class="w-100 places-b" id="interesting-places-bereg"><i class="interest-tochki"></i>Интересные места</p>
                </div>

            <!-- Функциональные кнопки --->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                    <p class="count-on" id="bereg-count-on"><i class="fa fa-check-square" aria-hidden="true"></i>Показать количество маркеров</p>
                    <p class="markers-on">Показать все маркеры<i class="fa fa-eye"></i></p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                    <p class="count-off" id="bereg-count-off"><i class="fa fa-square" aria-hidden="true"></i>Скрыть количество маркеров</p>
                    <p class="markers-off"><i class="fa fa-eye-slash"></i>Скрыть все маркеры</p>
                </div>
            
        </div>
        <!-- Контент страницы -->
        <div class="col-lg-12">
            <!-- Маркеры выходов в зависимости от спавна -->
            <div class="random-exits">
                <div class="btn-group w-100" data-toggle="buttons">

                    <label class="btn btn-primary w-100 house-spawn remastered active">
                        <input type="radio" name="options" id="option1" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                        <span>Выходы для спавна Деревня</span>
                    </label>

                    <br>
                    <br>

                    <label class="btn btn-primary w-100 remastered station-spawn">
                        <input type="radio" name="options" id="option2" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                        <span>Выходы для спавна Берег</span>
                    </label>

                </div>
                <br>
                <br>
            </div>

            <div class="static-description">
                <h2>Интерактивная карта Развязки</h2>
                <p>Интерактивная карта локации Развязка из Escape from Tarkov - на данной карте, вы сможете увидеть спавны и выходы за диких и ЧВК с локации Развязка, узнать о местонахождении оружейных и военных ящиков. </p>
                <p>Также с помощью интерактивной карты вы сможете узнать о местах спавна ключей от помещений и сейфов, которые спавнятся на карте Развязки. Интерактивная карта локации Развязка поможет вам очень быстро найти квестовые точки, на которых можно увидеть предметы, или места необходимые для выполнения квестов торговцев.</p>

                <p class="alert alert-danger"><b>В настоящий момент карта находится в разработке.</b></p>
            </div>

        </div>
    </div>
</div>