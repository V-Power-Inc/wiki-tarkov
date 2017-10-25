<?php

$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="heading-class">
    <div class="container">
        <h1 class="trader-heading">Квесты Лыжника</h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <ul class="nav nav-list bs-docs-sidenav">
                <?php foreach ($lyjnic as $item): ?>
                    <li><a data-toggle="tab" href="#<?=$item['tab_number']?>" class="relative"><i class="fa fa-chevron-right"></i><?=$item['title']?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">
            <div class="info-quests" id="info-alert-prapor" style="display: none;">
                <p class="alert alert-info sm-vertical-margin-20 size-16">Квесты Лыжника вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.</p>
                <img class="torgovec-info-quest-image" src="/img/torgovcy/lyjnic-quests/lyjnic_full.png" alt="Квесты торговца Лыжника из Escape from Tarkov">
            </div>
            <div class="tab-content">
                <?php foreach ($lyjnic as $item): ?>
                    <div id="<?=$item['tab_number']?>" class="tab-pane fade">
                        <?=$item['content']?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>