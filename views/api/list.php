<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 22:36
 *
 * Страница со списком имеющегося у нас в API количества уникальных предметов
 */

$this->title = 'Справочник лута в Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Актуальный справочник лута Escape From Tarkov'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Справочник лута Escape From Tarkov'
]);

// todo: Пропихнуть сюда рекламу

// todo: Я остановился на верстке этой странице - мне здесь нужна форма, для дальнейшей передачи параметра в API
?>
<hr class="grey-line">

<!-- Main page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <p class="alert alert-info size-16">Актуальный справочник лута Escape from tarkov, который постоянно актуализирует данные - воспользуйтесь поиском, чтобы узнать актуальную информацию о предмете, который вас интересует. Посмотреть информацию можно об абсолютно любом предмете, который вас интересует.
                <br>
                <br>
                Воспользуйтесь поиском в верхней части страницы, чтобы посмотреть информацию об интересующем вас предмете - в настоящий момент вы сможете узнать следующие данные о предмете:
                <ul>
                    <li>Полное название предмета</li>
                    <li>Категория предмета</li>
                    <li>Вес предмета</li>
                    <li>Сколько занимает в инвентаре</li>
                    <li>Описание предмета</li>
                    <li>У кого из Торговцев можно купить предмет</li>
                    <li>Кому из Торговцев можно продать предмет</li>
                    <li>Узнаете какие есть бартеры на предмет у Торговцев как на получение так и на продажу</li>
                </ul>
            </p>
        </div>
    </div>


    <!-- Main Page Content -->
    <div class="row">

        <!-- Main content Block -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 api-content">

        </div>


        <!-- left block -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

            <!-- Виджет Вконтакте -->
            <div class="vk-widget-styling">
                <?= $this->render('/other/wk-widget'); ?>
            </div>

            <!-- Виджет дискорда -->
            <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                <?= $this->render('/other/discord-widget.php'); ?>
                <?php  $this->endCache(); } ?>
        </div>


    </div>







</div>
