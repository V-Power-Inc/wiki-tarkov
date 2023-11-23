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
 * @var ApiLoot[] $items - массив AR объектов ApiLoot
 * @var Pagination $pagination - объект пагинации
 */

use app\common\constants\api\ItemAttributes;
use app\common\services\ImageService;
use app\models\ApiLoot;
use app\models\forms\ApiForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use kartik\typeahead\Typeahead;

$this->title = 'Справочник лута в Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Актуальный справочник лута Escape From Tarkov'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Справочник лута Escape From Tarkov'
]);
?>
<!-- Gorizontal information -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>


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
        <div class="col-xs-12 alert alert-info">
            <p class="size-16">
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

            <br>
            <b>Важно!!! Это справочник с актуальной информацией, который обновляется регулярно.</b>
            </p>
        </div>
    </div>

    <!-- Main Page Content -->
    <div class="row">

        <!-- Main content Block -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 api-content">
            <?php $form = ActiveForm::begin(['action' => ['/items'], 'options' => ['class' => 'form-search-block']]) ?>

                <?= Html::label('Название предмета') ?>
                <?= Typeahead::widget([
                    'name' => 'ApiForm[item_name]',
                    'scrollable' => true,
                    'options' => ['placeholder' => 'Введите сюда название предмета'],
                    'pluginOptions' => ['hint' => false, 'highlight' => true],
                    'dataset' => [
                        [
                            'remote' => [
                                'url' => Url::to(['items/search']) . '?q=%QUERY',
                                'wildcard' => '%QUERY',
                            ],
                            'limit' => 50,
                            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                            'display' => 'value',
                        ]
                    ]
                ]);
                ?>

                <br>

                <?= $form->field($form_model, ApiForm::ATTR_RECAPTCHA)->widget(
                    ReCaptcha::class,
                    ['siteKey' => '6LcNnTggAAAAAEK6rB1IcEZSdhVQyl_X5gEDNnxF']
                ) ?>

                <?= Html::submitButton('Осуществить поиск', ['class' => 'btn btn-success']) ?>

            <?php ActiveForm::end() ?>

            <!-- Items -->
            <?php if (!empty($items)): ?>

                <!-- Items blocks -->
                <?php foreach ($items as $item) : ?>

                    <?php $item->json = Json::decode($item->json) ?>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 boss-page-bg">

                        <!-- Name -->
                        <h2 class="text-left actual-items-block-title">

                            <i class="fa fa-check-circle checked-by-admins actual-items-block" title="Актуальная информация"></i>

                            <a href="/item/<?= $item->url ?>.html">
                                <?= $item->json[ItemAttributes::ATTR_ITEM_NAME] ?>
                            </a>
                        </h2>

                        <!-- Image -->
                        <div class="col-sm-2">
                            <a href="/item/<?= $item->url ?>.html">
                                <img class="item-page-image" src="<?= $item->json[ItemAttributes::ATTR_ICON_LINK] ?>" alt="<?= $item->json[ItemAttributes::ATTR_ITEM_NAME] ?>">
                            </a>
                        </div>

                        <!-- Attributes -->
                        <div class="col-sm-10">
                            <p class="item-page-text">Категория: <b><?= $item->json[ItemAttributes::ATTR_CATEGORY][ItemAttributes::ATTR_CATEGORY_NAME] ?></b></p>
                            <p class="item-page-text">Вес: <b><?= $item->json[ItemAttributes::ATTR_ITEM_WEIGHT] ?> кг.</b></p>

                            <div class="item-block-variables">
                                <p class="item-page-text">Где можно купить:</p>

                                <!-- Where we can buy -->
                                <?php foreach ($item->json[ItemAttributes::ATTR_BUY_FOR] as $trader) : ?>
                                    <img class="item-page-trader" src="<?= ImageService::traderImages($trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME]) ?>" alt="<?=$trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME] ?>" title="<?=$trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME] ?>">
                                <?php endforeach; ?>
                            </div>

                            <div class="item-block-variables">
                                <p class="item-page-text">Где можно продать:</p>

                                <!-- Where we can sell -->
                                <?php foreach ($item->json[ItemAttributes::ATTR_SELL_FOR] as $trader) : ?>
                                    <img class="item-page-trader" src="<?= ImageService::traderImages($trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME]) ?>" title="<?= $trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME] ?>" alt="<?= $trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME] ?>">
                                <?php endforeach; ?>
                            </div>

                        </div>

                    </div>
                <?php endforeach; ?>

                <?php if(!empty($pagination)): ?>
                    <div class="col-lg-12 pagination text-center">
                        <?= LinkPager::widget([
                            'pagination' => $pagination,
                        ]);
                        ?>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                <br>
                <p class="alert alert-danger size-16">К сожалению в настоящий момент нет доступных предметов, попробуйте зайти позже</p>
            <?php endif; ?>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>
        </div>

        <!-- right block -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php') ?>

            <br>
        </div>

    </div>

</div>