<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.12.2017
 * Time: 18:23
 */

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/map_hash.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/forest-location.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Карта локации Лес в Escape from Tarkov - интерактивная карта со спавнами Диких, точками военных ящиков и ключей';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Лес из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, дверей открываемых ключами.',
]);
?>

<!-- off ads -->
<?= $this->render('/other/disable-adblock.php'); ?>

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
<!-- Опции карты -->
<div class="optins_layerstability">
    <div class="outer-button"><img src="/img/maps/button_outer.png"></div>
    <div class="inner-button"><img src="/img/maps/button_inner.png"></div>
    <div class="col-lg-12">
        <div class="option-buttons">
            <h2 class="map-title">Маркеры</h2>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                <p class="dikie-b" id="spawns-dikie"><i class="dikie-spawns"></i>Спавны диких</p>
                <p class="gamers-b" id="spawns-chvk"><i class="chvk-spawns"></i>Спавны ЧВК</p>
                <p class="bandits-b" id="exits-dikie-forest"><i class="dikie-exits"></i>Выходы с карты за Диких</p>
                <p class="exits-b" id="exits-chvk-forest"><i class="chvk-exits"></i>Выходы с карты за ЧВК</p>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                <p class="voenka-b" id="weapons-forest"><i class="weapon-cases"></i>Оружейные ящики</p>
                <p class="polki-b" id="quest-forest"><i class="quest-tochki"></i>Квестовые точки</p>
                <p class="keys-b" id="keys-forest"><i class="doors-tochki"></i>Открываемые двери</p>
                <p class="places-b" id="interesting-places-forest"><i class="interest-tochki"></i>Интересные места</p>
            </div>

            <!-- Функциональные кнопки --->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                <p class="count-on" id="forest-count-on"><i class="fa fa-check-square" aria-hidden="true"></i>Показать количество маркеров</p>
                <p class="markers-on">Показать все маркеры<i class="fa fa-eye"></i></p>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">
                <p class="count-off" id="forest-count-off"><i class="fa fa-square" aria-hidden="true"></i>Скрыть количество маркеров</p>
                <p class="markers-off"><i class="fa fa-eye-slash"></i>Скрыть все маркеры</p>
            </div>
            
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
                <h2>Интерактивная карта Леса</h2>
                <p>Интерактивная карта локации Лес из Escape from Tarkov - на данной карте, вы сможете увидеть выходы за диких и ЧВК с локации Лес, узнать о местонахождении оружейных и военных ящиков, а также многое другое. </p>
                <p>Также с помощью интерактивной карты вы сможете узнать о местах спавна ключей от помещений и сейфов, которые спавнятся на карте Лес с определенной вероятностью, производственного лута и квестовых предметов необходимых для прохождения заданий от торговцев. Интерактивная карта локации Лес поможет вам очень быстро найти квестовые точки, на которых можно увидеть предметы, или места необходимые для выполнения квестов торговцев.</p>
                <p>Есть возможность узнать спавны ЧВК и Диких на карте Лес, с картинками их месторасположений, а также комментариями о различных особенностях этих спавнов. </p>
               <!-- <p class="alert alert-danger">Спавны ЧВК, Диких а также места спавна ключей и оружия могут изменяться в каждом последующем патче.</p> -->
                <p></p>
                <?= $this->render('/other/google-gor.php'); ?>
            </div>

        </div>
    </div>
</div>