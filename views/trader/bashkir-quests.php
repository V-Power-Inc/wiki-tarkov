<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.07.2018
 * Time: 15:01
 */

$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->title = 'Квесты Башкира в Escape from Tarkov. Разбор и прохождение квестов Башкира.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Прохождение и разбор квестов Башкира по онлайн-шутеру Escape from Takov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Квесты Башкира в Escape from Tarkov, квесты башкир Тарков',
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
                <?php foreach ($bashkir as $item): ?>
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

            <?= $this->render('/other/yandex-donate.php'); ?>

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>
        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">
            <div class="info-quests" id="info-alert-prapor" style="display: none;">
                <p class="alert alert-info sm-vertical-margin-20 size-16">Написать в текст - в данный момент его нет.<br>
                    <!--                    <br><b>Квесты актуальны на патч 0.8.5.1369</b>-->
                </p>
                <!-- Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна. -->


                <!--                <p class="alert alert-danger size-16">В настоящий момент здесь опубликованы не все квесты этого торговца, в ближайшее время появятся недостающие.</p>-->
                <!--                <img class="torgovec-info-quest-image" src="/img/torgovcy/mehanic-quests/leshy-full.jpg" alt="Квесты торговца Лыжника из Escape from Tarkov">-->
            </div>
            <div class="tab-content">
                <?php foreach ($bashkir as $item): ?>
                    <div id="<?=$item['tab_number']?>" class="tab-pane fade">
                        <?php if ($item['preview']):?> <img class="preview-small-image" src="<?= $item['preview'] ?>" alt="<?= $item['title'] ?>"> <?php endif; ?>
                        <?=$item['content']?>
                    </div>
                <?php endforeach; ?>
            </div>

            <br>
            <button class="btn btn-primary"><a href="/quests-of-traders" style="color: white; text-decoration: none;">Вернуться к списку торговцев</a></button>
        </div>

        <div class="recommended-gm-content">
            <?= $this->render('/other/google-recommended.php'); ?>
        </div>

        <!-- Расстояние - заглушка -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>

        <!-- Комментарии -->
        <?= $this->render('/other/comments');?>

    </div>
</div>