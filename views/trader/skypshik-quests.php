<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 28.07.2018
 * Time: 22:38
 */

$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->title = 'Квесты Скупщика в Escape from Tarkov. Разбор и прохождение квестов Скупщика.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Прохождение и разбор квестов Скупщика по онлайн-шутеру Escape from Takov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Квесты скупщика в Escape from Tarkov, квесты скупщика Тарков',
]);
?>
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>

        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <ul class="nav nav-list bs-docs-sidenav">
                <?php foreach ($skypshik as $item): ?>
                    <li><a data-toggle="tab" href="#<?=$item['tab_number']?>" class="relative"><i class="fa fa-chevron-right"></i><?=$item['title']?></a></li>
                <?php endforeach; ?>
            </ul>

            <div class="margin-top-20">

                <!-- Виджет Вконтакте -->
                <div class="vk-widget-styling">
                    <?= $this->render('/other/wk-widget'); ?>
                </div>

                <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                    <?= $this->render('/other/discord-widget.php'); ?>
                <?php  $this->endCache(); } ?>
            </div>

            <!-- Essense -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">
            <div class="info-quests" id="info-alert-prapor" style="display: none;">
                <p class="alert alert-info sm-vertical-margin-20 size-16">Квесты Скупщика вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.</p>
                <!--                <img class="torgovec-info-quest-image" src="#" alt="Квесты торговца Скупщика из Escape from Tarkov">-->
            </div>
            <div class="tab-content">
                <?php foreach ($skypshik as $item): ?>
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

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 nulled-pdng bordered-recomend">
            <?= $this->render('/other/google-recommended.php'); ?>
        </div>

        <!-- Расстояние заглушка -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 height-25"></div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 comment-fake-side">
            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>
        </div>


    </div>

</div>