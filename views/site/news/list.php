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

$keysBlocks = [6,12];

use app\components\AlertComponent;
?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Новости по Escape from Tarkov</h1>
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

                <?php if(in_array($k,$keysBlocks)): ?>
                    <!-- feed recomendations -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="news-shortitem static-height-afm">
                             <?= $this->render('/other/adsense-feed.php'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="news-shortitem">
                        <p class="news-short-title"><a class="news-link" href="/news/<?=$item['url']?>"><?=$item['title']?></a></p>
                        <span class="news-date"><?=date('d-m-Y',strtotime($item['date_create']))?></span>
                        <a class="news-link" href="/news/<?=$item['url']?>"><img class="news-titleimage" alt="<?=$item['title']?>" src="<?=$item['preview']?>"></a>
                        <div class="text-left news-short-text"><?= $item['shortdesc'] ?></div>
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

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

            <!-- Виджет Вконтакте -->
            <div class="vk-widget-styling">
                <?= $this->render('/other/wk-widget'); ?>
            </div>

            <!-- Виджет дискорда -->
            <div class="margin-top-20"></div>
            <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>

            <?= $this->render('/other/yandex-donate.php'); ?>

        </div>
        
    </div>
</div>


