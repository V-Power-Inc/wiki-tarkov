<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 26.10.2017
 * Time: 15:05
 */

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/map_hash.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                    <p class="dikie-b" id="spawns-dikie-zavod"><i class="dikie-spawns"></i>Спавны диких</p>
                    <p class="gamers-b" id="spawns-chvk-zavod"><i class="chvk-spawns"></i>Спавны ЧВК</p>
                    <p class="bandits-b" id="exits-dikie-zavod"><i class="dikie-exits"></i>Выходы с карты за Диких</p>
                    <p class="exits-b" id="exits-chvk-zavod"><i class="chvk-exits"></i>Выходы с карты за ЧВК</p>
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                    <p class="voenka-b" id="weapons-zavod"><i class="weapon-cases"></i>Оружейные ящики</p>
                    <p class="polki-b" id="quests-zavod"><i class="quest-tochki"></i>Квестовые точки</p>
                    <p class="w-100 keys-b" id="doors-zavod"><i class="doors-tochki"></i>Открываемые двери</p>
                    <p class="w-100 places-b" id="interesting-zavod"><i class="interest-tochki"></i>Интересные места</p>
                </div>

                <!-- Функциональные кнопки --->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons padding-top-30">
                    <p class="count-on" id="zavod-count-on"><i class="fa fa-check-square" aria-hidden="true"></i>Показать количество маркеров</p>
                    <p class="markers-on">Показать все маркеры<i class="fa fa-eye"></i></p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons padding-top-30">
                    <p class="count-off" id="zavod-count-off"><i class="fa fa-square" aria-hidden="true"></i>Скрыть количество маркеров</p>
                    <p class="markers-off"><i class="fa fa-eye-slash"></i>Скрыть все маркеры</p>
                </div>
                
            </div>
            <!-- Контент страницы -->
            <div class="col-lg-12">
                <div class="static-description">
                    <h2>Интерактивная карта Завода</h2>
                    <p>Интерактивная карта локации Завод из Escape from Tarkov - на данной карте, вы сможете увидеть выходы за диких и ЧВК с локации Завод, узнать о местонахождении оружейных и военных ящиков, а также многое другое. </p>
                    <p>Также с помощью интерактивной карты вы сможете узнать о местах спавна ключей от помещений и сейфов, которые спавнятся на карте Завод, производственного лута и квестовых предметов необходимых для прохождения заданий от торговцев.</p>
                    <p>Есть возможность узнать спавны ЧВК и Диких на карте Завод, с картинками их месторасположений, а также комментариями о различных особенностях этих спавнов. </p>
                    <p class="alert alert-info">Информацию о спавне <b>ключа от Выхода с Завода</b> и открываемым этим ключом дверям вы <b><a href="/keys/key-of-exit-zavod" style="color: #d9534f;" target="_blank">сможете найти в нашей статье.</a></b> </p>
                    <p></p>
                </div>

            </div>
        </div>
    </div>







