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

use app\components\AlertComponent;
?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Карты локаций Escape from Tarkov</h1>
    </div>
</div>

<hr class="grey-line">

<?php if((AlertComponent::alert()->enabled !== 0)) : ?>
    <!-- Информационная строка -->
    <div class="row">
        <div class="container">
            <div class="col-lg-12 <?= AlertComponent::alert()->bgstyle ?>">
                <marquee style="font-size: 16px; color: white; font-weight: bold; margin-top: 4px;"><?= AlertComponent::alert()->content ?></marquee>
            </div>
        </div>
    </div>
    <hr class="grey-line">
<?php endif; ?>


<div class="container">
    <div class="row white-content">
        <div class="col-lg-12">
            <p class="alert alert-info size-16">В этом резделе сайта вы можете перейти к интерактивным картам локаций из Escape from Tarkov. На интерактивных картах будут отображены ключи от помещений а также информация о том где эти ключи можно найти.</p>
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
            <img class="maps__small" src="/img/maps/razvyazka_small.jpg">
            <br>
            <br>
            <p class="alert alert-danger"><b>Локация была анонсирована разработчиками.</b></p>
<!--                <a class="btn btn-default main-link" href="#">Перейти к карте Развязки</a>-->
        </div>
    </div>
        
        
        
        
        
        
        
        
        
        
    </div>
    
    
</div>