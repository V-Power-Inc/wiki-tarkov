<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 22:36
 *
 * Страница со списком имеющегося у нас в API количества уникальных предметов
 *
 * @var ApiForm $form_model - Объект формы для загрузки поискового запроса
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

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\forms\ApiForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use yii\helpers\Json;
use app\common\services\ImageService;

// todo: Пропихнуть сюда рекламу

// todo: Я остановился на верстке этой странице - мне здесь нужна форма, для дальнейшей передачи параметра в API
?>
<hr class="grey-line">

<!-- Main page content -->
<div class="container">

    <div class="row">
        <!-- Flash info -->
        <?php  if(Yii::$app->getSession()->getFlash('message')):?>
            <?=Yii::$app->getSession()->getFlash('message')?>
        <?php endif;?>
    </div>

    <div class="row">
        <div class="col-xs-12 alert alert-info size-16">
            Актуальный справочник лута Escape from tarkov, который постоянно актуализирует данные - воспользуйтесь поиском, чтобы узнать актуальную информацию о предмете, который вас интересует. Посмотреть информацию можно об абсолютно любом предмете, который вас интересует.
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
        </div>
    </div>


    <!-- Main Page Content -->
    <div class="row">

        <!-- Main content Block -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 api-content">
            <?php $form = ActiveForm::begin() ?>

                <?= $form->field($form_model, ApiForm::ATTR_ITEM_NAME) ?>

                <?= $form->field($form_model, ApiForm::ATTR_RECAPTCHA)->widget(
                    ReCaptcha::class,
                    ['siteKey' => '6LcNnTggAAAAAEK6rB1IcEZSdhVQyl_X5gEDNnxF']
                ) ?>

                <?= Html::submitButton('Осуществить поиск', ['class' => 'btn btn-success']) ?>

            <?php ActiveForm::end() ?>


            <!-- Items -->
            <?php if (!empty($items)): ?>

                <!-- Items blocks -->
                <?php foreach ($items as $item) : $item->json = Json::decode($item->json) ?>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 boss-page-bg">

                        <!-- Name -->
                        <h2 class="text-left">
                            <!-- todo: Ссылка в деталку -->
                            <a href="#">
                                <?= $item->json['name'] ?>
                            </a>
                        </h2>

                        <!-- Image -->
                        <div class="col-sm-2">
                            <!-- todo: Ссылка в деталку -->
                            <a href="#">
                                <img class="item-page-image" src="<?= $item->json['iconLink'] ?>">
                            </a>
                        </div>

                        <!-- Attributes -->
                        <div class="col-sm-10">
                            <p class="item-page-text">Категория: <b><?= $item->json['category']['name'] ?>%</b></p>
                            <p class="item-page-text">Вес: <b><?= $item->json['weight'] ?> кг.</b></p>
                            <p class="item-page-text">Где можно купить:</p>

                            <!-- Where we can buy -->
                            <?php foreach ($item->json['buyFor'] as $trader) : ?>
                                <img class="item-page-trader" src="<?= ImageService::traderImages($trader['vendor']['name']) ?>" alt="<?=$trader['vendor']['name'] ?>">
                            <?php endforeach; ?>

                            <p class="item-page-text">Где можно продать:</p>

                            <!-- Where we can sell -->
                            <?php foreach ($item->json['sellFor'] as $trader) : ?>
                                <img class="item-page-trader" src="<?= ImageService::traderImages($trader['vendor']['name']) ?>">
                            <?php endforeach; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif;?>

        </div>


        <!-- left block -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <!-- $this->render('/other/yandex-direct.php'); -->

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
