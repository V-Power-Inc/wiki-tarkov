<?php

/* @var $this yii\web\View */
$this->registerJsFile('js/owl-init.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/owl-js/owl.carousel.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'База знаний Escape from Tarkov. Карты локаций, ключи от дверей, разбор квестов торговцев';
?>
<div class="owl-carousel owl-theme">
    <div class="owl-item">
        <img src="/img/slider/eft-1.jpg">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-2.jpg">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-3.jpg">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-4.jpg">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-5.jpg">
    </div>
</div>

<div class="container padding-top-0">
    <div class="site-index">
    
        <div class="jumbotron jumbotron-main">
            <h1 class="margin-top-10">База знаний Escape from Tarkov</h1>
    
            <p class="lead">Здесь вы найдете информацию о важных аспектах внутриигрового процесса игры Escape from Tarkov. На сайте вы можете найти информацию о квестах торговцев, ключах от дверей и найти рекомендации по прохождению рейдов.</p>
    
            <p><a class="btn btn-lg btn-success main-inter-link mobile-display-none" href="#">Перейти к интерактивным картам Escape from Tarkov</a></p>
        </div>
    
        <div class="body-content">
    
            <div class="row">
                <div class="col-lg-4">
                    <h2>Задачи у торговцев</h2>
    
                    <p class="size-16">В этом разделе вы можете найти информацию о всех доступных квестах торговцев в Escape from Tarkov. Здесь собраны рекомендации по прохождению квестов, описания квестов, а также важные нюансы, которые являются неочевидными в процессе прохождения квестов Escape from Tarkov.</p>
    
                    <p><a class="btn btn-default main-link" href="/quests-of-traders">Перейти в раздел квестов EFT</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Ключи от дверей</h2>
    
                    <p class="size-16">В данном разделе - вы сможете найти информацию о любом ключе открывающим двери и помещения в Escape from Tarkov. Вы сможете увидеть где можно найти тот или иной ключ, как выглядят открываемые двери а также увидеть что находится внутри открытых вами помещений.</p>
    
                    <p><a class="btn btn-default main-link" href="#">Перейти в раздел ключей EFT</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Карты локаций</h2>
    
                    <p class="size-16">Здесь вы сможете воспользоваться интерактивными картами локаций Escape from Tarkov - воспользоваться поиском ключей, посмотреть как выглядят карты локаций, сделать пометки по прохождению рейда. Очень полезный инструмент, который пригодится всем игрокам Escape from Tarkov.</p>
    
                    <p><a class="btn btn-default main-link" href="/maps">Перейти к интерактивным картам EFT</a></p>
                </div>
    
            </div>
    
        </div>
    </div>
</div>