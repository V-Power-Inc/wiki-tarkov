<?php

$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Квесты Терапевта в Escape from Tarkov. Разбор и прохождение квестов Терапевта.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Прохождение и разбор квестов Терапевта по онлайн-шутеру Escape from Takov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Квесты терапевта в Escape from Tarkov, квесты терапевт Тарков',
]);

use app\components\AlertComponent;
?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Квесты Терапевта</h1>
    </div>
</div>

<hr class="grey-line" style="border-top: 0;">

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
        
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <ul class="nav nav-list bs-docs-sidenav">
                <?php foreach ($terapevt as $item): ?>
                    <li><a data-toggle="tab" href="#<?=$item['tab_number']?>" class="relative"><i class="fa fa-chevron-right"></i><?=$item['title']?></a></li>
                <?php endforeach; ?>
            </ul>

            <div class="margin-top-20">

                <!-- Виджет Вконтакте -->
                <div class="vk-widget-styling">
                    <?= $this->render('/other/wk-widget'); ?>
                </div>

                <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                    <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
                <?php  $this->endCache(); } ?>
            </div>

            <!-- Essense -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>
        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">
            <div class="info-quests" id="info-alert-prapor" style="display: none;">
                <p class="alert alert-info sm-vertical-margin-20 size-16">Квесты Терапевта вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.</p>
                <img class="torgovec-info-quest-image" src="/img/torgovcy/terapevt-quests/terapevt_full.jpg" alt="Квесты торговца Терапевта из Escape from Tarkov">
            </div>
            <div class="tab-content">
                <?php foreach ($terapevt as $item): ?>
                    <div id="<?=$item['tab_number']?>" class="tab-pane fade">
                        <?php if ($item['preview']):?> <img class="preview-small-image" src="<?= $item['preview'] ?>" alt="<?= $item['title'] ?>"> <?php endif; ?>
                        <?=$item['content']?>
                    </div>
                <?php endforeach; ?>
            </div>

            <br>
            <button class="btn btn-primary"><a href="/quests-of-traders" style="color: white; text-decoration: none;">Вернуться к списку торговцев</a></button>
        </div>

        <!-- Расстояние заглушка -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 height-25"></div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 nulled-pdng">
            <div class="bordered-recomend">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>
        </div>

        <!-- Расстояние заглушка -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 height-25"></div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 comment-fake-side">
            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>
        </div>


        <div class="recommended-gm-content">
            <?= $this->render('/other/google-recommended.php'); ?>
        </div>
        


        
    </div>
</div>