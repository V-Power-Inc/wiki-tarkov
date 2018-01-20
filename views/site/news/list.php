<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 20.01.2018
 * Time: 14:28
 */

use yii\widgets\LinkPager;

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
<!--        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">-->
<!--            <ul class="nav nav-list bs-docs-sidenav">-->
<!--                <li><a data-toggle="tab" href="#2" class="relative"><i class="fa fa-chevron-right"></i>Материалы за 2017</a></li>-->
<!--                <li><a data-toggle="tab" href="#2" class="relative"><i class="fa fa-chevron-right"></i>Материалы за 2018</a></li>-->
<!--                <li><a data-toggle="tab" href="#2" class="relative"><i class="fa fa-chevron-right"></i>Материалы за 2019</a></li>-->
<!--            </ul>-->
<!--        </div>-->
        
        
        <!-- Основной блок контента -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 quests-content">

            <p class="alert alert-info sm-vertical-margin-20 size-16">
                Escape from Tarkov - онлайн-шутер, который в данный момент находится на стадии разработки, в связи с чем мы можем регулярно узнавать о патчах и грядущих изменениях. Эта игра очень часто вместе с патчами очень сильно видоизменяется, этот раздел создан для того чтобы вы могли видеть актуальную информацию о стадии разработки игры, а также могли читать чейнджлоги патчей, которые уже попали в релиз.
            </p>

                <!--- Новостной блок -->
            <?php foreach($news as $item): ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="news-shortitem">
                        <p class="news-short-title"><a class="news-link" href="/news/<?=$item['url']?>"><?=$item['title']?></a></p>
                        <span class="news-date"><?=$item['date_create']?></span>
                        <a class="news-link" href="/news/<?=$item['url']?>"><img class="news-titleimage" src="<?=$item['preview']?>"></a>
                        <div class="text-left"><?=$item['content'] ?></div>
                        <p class="text-right"><a class="btn btn-default main-link" href="/news/<?=$item['url']?>">Читать детально</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
                <!-- Окончание новостного блока -->

            <!-- Пагинатор -->
            <div class="row">
                <div class="col-lg-12 pagination text-center">
                    <?= LinkPager::widget([
                        'pagination' => $pagination,
                        'firstPageLabel' => 'первая',
                        'lastPageLabel' => 'последняя',
                        'prevPageLabel' => '&laquo;',
                        'prevPageLabel' => '&laquo;',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


