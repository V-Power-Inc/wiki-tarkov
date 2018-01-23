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

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Карты локаций Escape from Tarkov</h1>
    </div>
</div>

<hr class="grey-line">




<div class="container">
    <div class="row white-content">
        <div class="col-lg-12">
            <p class="alert alert-info size-16">В этом резделе сайта вы можете перейти к интерактивным картам локаций из Escape from Tarkov. На интерактивных картах будут отображены ключи от помещений а также информация о том где эти ключи можно найти.</p>
        </div>
        
        
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
            <h2 class="text-center map-heading">Карта Завода</h2>
            <a href="/maps/zavod-location"><img class="maps__small" src="/img/maps/zavod_small.jpg"></a>
            <br>
            <br>
            <a class="btn btn-default main-link" href="/maps/zavod-location">Перейти к карте Завода</a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
            <h2 class="text-center map-heading">Карта Леса</h2>
            <a href="/maps/forest-location"><img class="maps__small" src="/img/maps/forest_small.jpg"></a>
            <br>
            <br>
            <a class="btn btn-default main-link" href="/maps/forest-location">Перейти к карте Леса</a>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
            <h2 class="text-center map-heading">Карта Таможни</h2>
            <a href="/maps/tamojnya-location"><img class="maps__small" src="/img/maps/tamojnya_small.jpg"></a>
            <br>
            <br>
<!--            <p class="alert alert-danger"><b>В разработке</b></p>-->
           <a class="btn btn-default main-link" href="/maps/tamojnya-location">Перейти к карте Таможни</a>
        </div>
        
    </div>
    
    
    
    
</div>