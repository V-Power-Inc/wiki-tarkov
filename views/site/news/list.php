<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 20.01.2018
 * Time: 14:28
 */

use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\models\News;

/**
 * @var News[] $news - массив AR объектов класса новостей
 * @var Pagination $pagination - объект пагинации
 */

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
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>
        
        <!-- Основной блок контента -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">

            <p class="alert alert-info sm-vertical-margin-20 size-16">
                Escape from Tarkov - онлайн-шутер, который в данный момент находится на стадии разработки, в связи с чем мы можем регулярно узнавать о патчах и грядущих изменениях. Эта игра очень часто вместе с патчами очень сильно видоизменяется, этот раздел создан для того чтобы вы могли видеть актуальную информацию о стадии разработки игры, а также могли читать чейнджлоги патчей, которые уже попали в релиз.
            </p>

                <!--- Новостной блок -->
            <?php foreach($news as $k => $item): ?>

                <?php if(in_array($k,Yii::$app->params['keysBlocks'])): ?>
                    <!-- feed recomendations -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="news-shortitem static-height-afm">
                             <?= $this->render('/other/adsense-feed.php'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="news-shortitem">
                        <p class="news-short-title"><a class="news-link" href="/news/<?=$item[News::ATTR_URL]?>"><?=$item[News::ATTR_TITLE]?></a></p>
                        <span class="news-date"><?=date('d-m-Y',strtotime($item[News::ATTR_DATE_CREATE]))?></span>
                        <a class="news-link" href="/news/<?=$item[News::ATTR_URL]?>"><img class="news-titleimage" alt="<?=$item[News::ATTR_TITLE]?>" src="<?=$item[News::ATTR_PREVIEW]?>"></a>
                        <div class="text-left news-short-text"><?= $item[News::ATTR_SHORTDESC] ?></div>
                        <p class="text-right"><a class="btn btn-default main-link" href="/news/<?=$item[News::ATTR_URL]?>">Читать детально</a></p>
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
                        'prevPageLabel' => '&laquo;'
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>
        </div>
        
    </div>
</div>