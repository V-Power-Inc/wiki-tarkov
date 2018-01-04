<?php

$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/disquss.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Квесты Миротворца в Escape from Tarkov. Разбор и прохождение квестов Лыжника.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Прохождение и разбор квестов Миротворца по онлайн-шутеру Escape from Takov.',
]);
?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Квесты Миротворца</h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <ul class="nav nav-list bs-docs-sidenav">
                <?php foreach ($mirotvorec as $item): ?>
                    <li><a data-toggle="tab" href="#<?=$item['tab_number']?>" class="relative"><i class="fa fa-chevron-right"></i><?=$item['title']?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">
            <div class="info-quests" id="info-alert-prapor" style="display: none;">
                <p class="alert alert-info sm-vertical-margin-20 size-16">Квесты Миротворца были добавлены в Escape from Tarkov в конце декабря 2017 года, теперь и с этим торговцем можно прокачивать репутацию и проходить квесты - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br>
<!--                    <br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.-->
                </p>
                <p class="alert alert-danger size-16">В настоящий момент здесь опубликованы не все квесты этого торговца, в ближайшее время появятся недостающие.</p>
                <img class="torgovec-info-quest-image" src="/img/torgovcy/mirotvorec-quests/mirotvorec-full.jpg" alt="Квесты торговца Лыжника из Escape from Tarkov">
            </div>
            <div class="tab-content">
                <?php foreach ($mirotvorec as $item): ?>
                    <div id="<?=$item['tab_number']?>" class="tab-pane fade">
                        <?php if ($item['preview']):?> <img class="preview-small-image" src="<?= $item['preview'] ?>" alt="<?= $item['title'] ?>"> <?php endif; ?>
                        <?=$item['content']?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Комментарии -->
        <div class="col-sm-12 disqs-comments">
            <div id="disqus_thread">

            </div>
        </div>
    </div>
</div>