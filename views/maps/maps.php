<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 26.10.2017
 * Time: 15:05
 */

$this->title = 'Карты локаций Escape from Tarkov - интерактивные карты с просмотром ключей от помещений';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Карты локаций Escape from Tarkov - интерактивные карты Леса, Завода - просмотр маркеров со спавнами',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Карта Леса Тарков, Карта таможни Тарков, Escape from tarkov интерактивные карты',
]);
?>
<!-- Gorizontal information -->
<div class="row">
    <div class="container">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row white-content">
        <div class="col-lg-12">
            <p class="alert alert-info size-16">В этом разделе сайта вы можете перейти к интерактивным картам локаций из Escape from Tarkov. На интерактивных картах будут отображены ключи от помещений а также информация о том где эти ключи можно найти.</p>
        </div>
        
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
            <h2 class="text-center map-heading">Карта Завода</h2>
            <a href="/maps/zavod-location#3/68.97/-8.00"><img class="maps__small" src="/img/maps/zavod_prev.jpg"></a>
            <br>
            <br>
            <a class="btn btn-default main-link" href="/maps/zavod-location#3/68.97/-8.00">Перейти к карте Завода</a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
            <h2 class="text-center map-heading">Карта Леса</h2>
            <a href="/maps/forest-location#3/72.50/-9.58"><img class="maps__small" src="/img/maps/forest_prev.jpg"></a>
            <br>
            <br>
            <a class="btn btn-default main-link" href="/maps/forest-location#3/72.50/-9.58">Перейти к карте Леса</a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
            <h2 class="text-center map-heading">Карта Таможни</h2>
            <a href="/maps/tamojnya-location#4/80.40/-75.98"><img class="maps__small" src="/img/maps/karta_tamozhnya_preview.png"></a>
            <br>
            <br>
<!--            <p class="alert alert-danger"><b>В разработке</b></p>-->
           <a class="btn btn-default main-link" href="/maps/tamojnya-location#4/80.40/-75.98">Перейти к карте Таможни</a>
        </div>
    </div>



    <div class="row maps-margin-top-30">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center margin-top-15">
            <h2 class="text-center map-heading">Карта Берега</h2>
            <a href="/maps/bereg-location#3/60.93/-10.81"><img class="maps__small" src="/img/maps/karta_bereg_preview.png"></a>
            <br>
            <br>
<!--                        <p class="alert alert-danger"><b>В разработке</b></p>-->
            <a class="btn btn-default main-link" href="/maps/bereg-location#3/60.93/-10.81">Перейти к карте Берега</a>
        </div>
   

        
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center margin-top-15">
            <h2 class="text-center map-heading">Карта Развязки</h2>
            <a href="/maps/razvyazka-location"><img class="maps__small" src="/img/maps/razvyazka_small.jpg"></a>

            <br>
            <br>


            <a class="btn btn-default main-link" href="/maps/razvyazka-location">Перейти к карте Развязки</a>

        </div>


        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center margin-top-15">
            <h2 class="text-center map-heading">Карта лаборатории Terra Group</h2>
            <a href="/maps/terragroup-laboratory-location#2/41.0/-1.2">
                <img class="maps__small" src="/img/maps/terra-group.png">
            </a>
            <br>
            <br>
        <a class="btn btn-default main-link" href="/maps/terragroup-laboratory-location#2/41.0/-1.2">Перейти к карте лаборатории Terra Group</a>

        </div>
    </div>



    <div class="row maps-margin-top-30">

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center margin-top-15">
            <h2 class="text-center map-heading">Карта Резерва</h2>
            <a href="/maps/rezerv-location">
                <img class="maps__small" src="/img/maps/rezerv.jpg">
            </a>
            <br>
            <br>
            <a class="btn btn-default main-link" href="/maps/rezerv-location">Перейти к карте Резерв</a>

        </div>


        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center margin-top-15">
            <h2 class="text-center map-heading">Карта Маяка</h2>
            <a href="/maps/lighthouse-location">
                <img class="maps__small" src="/img/maps/lighthouse.jpg">
            </a>
            <br>
            <br>
            <a class="btn btn-default main-link" href="/maps/lighthouse-location">Перейти к карте Маяк</a>

        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center margin-top-15">
            <h2 class="text-center map-heading">Карта Улицы Таркова</h2>
            <a href="/maps/streets-of-tarkov-location">
                <img class="maps__small" src="/img/maps/streets-of-tarkov.jpg">
            </a>
            <br>
            <br>
            <a class="btn btn-default main-link" href="/maps/streets-of-tarkov-location">Перейти к карте Улицы Таркова</a>

        </div>

    </div>
        

    </div>
</div>

<hr class="grey-line">

<!-- Gorizontal information -->
<div class="row">
    <div class="container">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>

