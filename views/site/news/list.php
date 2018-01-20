<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 20.01.2018
 * Time: 14:28
 */

// $this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Новости по онлайн-шутеру Escape from Tarkov.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Новости разработки, список чейнджлогов а также дневниик разработчиков Escape from Tarkov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Новости Escape from Tarkov, Новости Таркова',
]);

?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Новости по Escape from Tarkov</h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">
       <!-- Боковая колонка -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <ul class="nav nav-list bs-docs-sidenav">
                <li><a data-toggle="tab" href="#2" class="relative"><i class="fa fa-chevron-right"></i>Материалы за 2017</a></li>
                <li><a data-toggle="tab" href="#2" class="relative"><i class="fa fa-chevron-right"></i>Материалы за 2018</a></li>
                <li><a data-toggle="tab" href="#2" class="relative"><i class="fa fa-chevron-right"></i>Материалы за 2019</a></li>
            </ul>
        </div>
        
        
        <!-- Основной блок контента -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">

            <p class="alert alert-info sm-vertical-margin-20 size-16">
                Escape from Tarkov - онлайн-шутер, который в данный момент находится на стадии разработки, в связи с чем мы можем регулярно узнавать о патчах и грядущих изменениях. Эта игра очень часто вместе с патчами очень сильно видоизменяется, этот раздел создан для того чтобы вы могли видеть актуальную информацию о стадии разработки игры, а также могли читать чейнджлоги патчей, которые уже попали в релиз.
            </p>

                <!--- Новостной блок -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="news-shortitem">
                        <p class="news-short-title"><a class="news-link" href="#">Чейнджлог на патч 0384</a></p>
                        <img class="news-titleimage" src="/img/news/gstest.jpg">
                        <p class="news-shorttext">Специальную новость запилили разработчики escape from tarkov - через 10 дней мы узнаем истину. Карта была расширена, все довольны - це пздц.</p>
                        <p class="text-right"><a class="btn btn-default main-link" href="/quests-of-traders">Читать детально</a></p>
                    </div>
                </div>
                <!-- Окончание новостного блока -->

                <!--- Новостной блок -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="news-shortitem">
                        <p class="news-short-title"><a class="news-link" href="#">Чейнджлог на патч 0384</a></p>
                        <img class="news-titleimage" src="/img/news/gstest.jpg">
                        <p class="news-shorttext">Специальную новость запилили разработчики escape from tarkov - через 10 дней мы узнаем истину. Карта была расширена, все довольны - це пздц.</p>
                        <p class="text-right"><a class="btn btn-default main-link" href="/quests-of-traders">Читать детально</a></p>
                    </div>
                </div>
                <!-- Окончание новостного блока -->

            <!--- Новостной блок -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="news-shortitem">
                    <p class="news-short-title"><a class="news-link" href="#">Чейнджлог на патч 0384</a></p>
                    <a href="#"><img class="news-titleimage" src="/img/news/gstest.jpg"></a>
                    <p class="news-shorttext">Специальную новость запилили разработчики escape from tarkov - через 10 дней мы узнаем истину. Карта была расширена, все довольны - це пздц.</p>
                    <p class="text-right"><a class="btn btn-default main-link" href="/quests-of-traders">Читать детально</a></p>
                </div>
            </div>
            <!-- Окончание новостного блока -->
                
        
            
            
        </div>



    </div>
</div>


