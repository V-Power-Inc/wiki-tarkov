<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.11.2022
 * Time: 1:03
 *
 * Вьюха с детальной информацией о предмете из API
 *
 * @var yii\web\View $this
 * @var ApiLoot $item - AR объект ApiLoot с данными о предмете
 */

use app\models\ApiLoot;
use app\common\constants\api\ItemAttributes;
use app\common\services\{HighChartsService, AbstractItemsApiService};
use yii\helpers\Json;
use yii\web\JqueryAsset;
use yii\web\JsExpression;
use app\common\services\ImageService;
use miloschuman\highcharts\Highcharts;

$this->title = 'Предмет: ' . $item->name .' в Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Информация о характеристиках, покупке и продаже ' . $item->name . ' в Escape from Tarkov'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Escape From Tarkov, лут, ' . $item->name
]);

/** Декоридуем Json */
$item->json = Json::decode($item->json);

/** Подключаем попапы для картинок */
$this->registerJsFile('js/news.js', ['depends' => [JqueryAsset::class]]);

/** Подключаем сюда файл, который AJAX запросом будет генерить правильный график */
$this->registerJsFile('js/highcharts/highchart.js', ['depends' => [JqueryAsset::class]]);

/** Атрибут canonical (Т.к. из API могут прилетать полностью идентичные страницы, но урлы у них разные) */
$this->registerLinkTag(['rel' => 'canonical', 'href' => $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . Yii::$app->request->url]);
?>
<!-- Gorizontal information -->
<div class="row">
    <div class="container">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>

<hr class="grey-line">

<!-- Main page content -->
<div class="container">
    <div class="row">

        <!-- Main Page Content -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 keys-content api-item-detail" data-item-id="<?= $item->json[ItemAttributes::ATTR_ITEM_ID] ?>">

            <!-- Image block -->
            <div class="col-xs-3">

                <a class="image-link" title="<?= $item->name ?>" href="<?= AbstractItemsApiService::setupImageWithCheckingName($item->name, $item->json[ItemAttributes::ATTR_INSPECT_IMAGE_LINK]) ?>">
                    <img class="detail-item-image image-link" src="<?= AbstractItemsApiService::setupImageWithCheckingName($item->name, $item->json[ItemAttributes::ATTR_INSPECT_IMAGE_LINK]) ?>" alt="<?= $item->name ?>">
                </a>

            </div>

            <!-- Main content -->
            <div class="col-xs-9">

                <p class="title-of-item-block">Категория: <?= $item->json[ItemAttributes::ATTR_CATEGORY][ItemAttributes::ATTR_CATEGORY_NAME] ?></p>

                <p class="title-of-item-block">Описание: </p>

                <p class="size-16">Описание: <?= $item->json[ItemAttributes::ATTR_ITEM_DESCRIPTION] ?? 'Отсутствует' ?></p>

                <p class="title-of-item-block">Можно купить: <?= !empty($item->json[ItemAttributes::ATTR_BUY_FOR]) ? '' : 'Нет' ?></p>

                <!-- buying -->
                <?php foreach($item->json[ItemAttributes::ATTR_BUY_FOR] as $trader): ?>

                    <div class="selling-block row">

                        <div class="col-sm-2">
                            <img class="detail-item-trader" src="<?= ImageService::traderImages($trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME]) ?>" alt="<?= $trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME] ?>" title="<?= $trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME] ?>">
                        </div>

                        <div class="col-sm-10">
                            <p class="detail-item-trader-price">За: <?= $trader[ItemAttributes::ATTR_VENDOR_PRICE] ?> <?= $trader[ItemAttributes::ATTR_VENDOR_CURRENCY] ?></p>

                            <!-- More info -->
                            <?= $trader[ItemAttributes::ATTR_VENDOR_CURRENCY] !== 'RUB' ? '<p class="detail-item-trader-price">В рублях: '. $trader[ItemAttributes::ATTR_VENDOR_PRICE_RUB] .'</p>' : '' ?>

                        </div>

                    </div>
                <?php endforeach; ?>


                <p class="title-of-item-block">Можно продать: <?= !empty($item->json[ItemAttributes::ATTR_SELL_FOR]) ? '' : 'Нет' ?></p>

                <!-- sells -->
                <?php foreach($item->json[ItemAttributes::ATTR_SELL_FOR] as $trader): ?>

                    <div class="selling-block row">

                        <div class="col-sm-2">
                            <img class="detail-item-trader" src="<?= ImageService::traderImages($trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME]) ?>" title="<?= $trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME] ?>" alt="<?= $trader[ItemAttributes::ATTR_VENDOR][ItemAttributes::ATTR_VENDOR_NAME] ?>">
                        </div>

                        <div class="col-sm-10">
                            <p class="detail-item-trader-price">За: <?= $trader[ItemAttributes::ATTR_VENDOR_PRICE] ?> <?= $trader[ItemAttributes::ATTR_VENDOR_CURRENCY] ?></p>

                            <!-- More info -->
                            <?= $trader[ItemAttributes::ATTR_VENDOR_CURRENCY] !== 'RUB' ? '<p class="detail-item-trader-price">В рублях: '. $trader[ItemAttributes::ATTR_VENDOR_PRICE_RUB] .'</p>' : '' ?>

                        </div>

                    </div>
                <?php endforeach; ?>


                <p class="title-of-item-block">Можно выменять: <?= !empty($item->json[ItemAttributes::ATTR_BARTERS_FOR]) ? '' : 'Нет' ?></p>

                <!-- barters block -->
                <?php foreach($item->json[ItemAttributes::ATTR_BARTERS_FOR] as $barter) : ?>

                    <div class="barters-block-actual row">

                        <div class="col-sm-2">
                            <img class="detail-item-trader" src="<?= ImageService::traderImages($barter[ItemAttributes::ATTR_TRADER][ItemAttributes::ATTR_TRADER_NAME]) ?>" title="<?= $barter[ItemAttributes::ATTR_TRADER][ItemAttributes::ATTR_TRADER_NAME] ?>" alt="<?= $barter[ItemAttributes::ATTR_TRADER][ItemAttributes::ATTR_TRADER_NAME] ?>">
                        </div>

                        <div class="col-sm-10">
                            <p class="detail-item-barter-info">Уровень: <?= $barter[ItemAttributes::ATTR_TRADER_LEVEL] ?></p>

                            <p class="detail-item-barter-info">Требуются выполненные квесты: <?= !empty($barter[ItemAttributes::ATTR_TASK_UNLOCK]) ? 'Да' : 'Нет' ?></p>

                            <p class="detail-item-barter-info">Для обмена нужны предметы:</p>

                            <!-- Required items - block -->
                            <?php foreach($barter[ItemAttributes::ATTR_REQUIRED_ITEMS] as $req_item): ?>

                                <div class="barter-items-count">
                                    <span class="count-for-barter"> <b><?= $req_item[ItemAttributes::ATTR_COUNT] ?>x</b></span> <img class="items-for-trade" src="<?= AbstractItemsApiService::setupImageWithCheckingUrl($item->url, $req_item[ItemAttributes::ATTR_ITEM][ItemAttributes::ATTR_ICON_LINK]) ?>" title="<?= $req_item[ItemAttributes::ATTR_ITEM][ItemAttributes::ATTR_ITEM_NAME] ?>" alt="<?= $req_item[ItemAttributes::ATTR_ITEM][ItemAttributes::ATTR_ITEM_NAME] ?>">
                                </div>

                            <?php endforeach; ?>

                        </div>

                    </div>

                <?php endforeach; ?>


                <p class="title-of-item-block">Можно получить в награду за задания: <?= !empty($item->json[ItemAttributes::ATTR_RECIEVED_FOR_TASKS]) ? '' : 'Нет' ?></p>

                <!-- Received for Quests -->
                <?php foreach($item->json[ItemAttributes::ATTR_RECIEVED_FOR_TASKS] as $recieved): ?>

                <div class="received-block row">

                    <div class="col-sm-2">
                        <img class="detail-item-trader" src="<?= ImageService::traderImages($recieved[ItemAttributes::ATTR_TRADER][ItemAttributes::ATTR_TRADER_NAME]) ?>" title="<?= $recieved[ItemAttributes::ATTR_TRADER][ItemAttributes::ATTR_TRADER_NAME] ?>" alt="<?= $recieved[ItemAttributes::ATTR_TRADER][ItemAttributes::ATTR_TRADER_NAME] ?>">
                    </div>

                    <div class="col-sm-10">
                        <p class="detail-item-barter-info">Выдает за выполнение: <b><?= $recieved[ItemAttributes::ATTR_ITEM_NAME] ?></b></p>
                    </div>

                </div>

                <?php endforeach; ?>

                <!-- История цен на предмет -->
                <div class="row received-block">
                    <div class="col-sm-12">
                        <div class="graphs__of__items">
                            <?= Highcharts::widget([
                                'options' => [
                                    'chart' => [
                                        'backgroundColor' => HighChartsService::getBackgroundByTheme(),
                                    ],
                                    'title' => [
                                        'text' => 'История последних сделок по предмету',
                                        'style' => [
                                            'color' => HighChartsService::getTextByTheme()
                                        ]
                                    ],
                                    'xAxis' => [
                                        /** Данные сюда JS зааплоадит - HighCharts */
                                        'categories' => [],
                                        'labels' => [
                                            'style' => [
                                                'color' => HighChartsService::getTextByTheme()
                                            ]
                                        ]
                                    ],
                                    'yAxis' => [
                                        'title' => [
                                            'text' => 'Стоимость',
                                            'style' => [
                                                'color' => HighChartsService::getTextByTheme()
                                            ]
                                        ],
                                        'labels' => [
                                            'style' => [
                                                'color' => HighChartsService::getTextByTheme()
                                            ]
                                        ]
                                    ],
                                    'legend' => [
                                        'itemStyle' => [
                                            'color' => HighChartsService::getTextByTheme()
                                        ],
                                        'itemHoverStyle' => [
                                            'color' => HighChartsService::getTextByTheme()
                                        ],
                                    ],
                                    'series' => [
                                        [
                                            'name' => 'Цена сделки - руб.',
                                            /** Данные сюда JS зааплоадит - HighCharts */
                                            'data' => [],
                                            'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "orange"')
                                        ],
                                    ]
                                ]
                            ]) ?>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Back to items List Page -->
            <a href="/items" class="pull-right"><button type="button" class="btn btn-primary margin-top-15">Вернуться к списку предметов</button></a>

            <div class="recommended-gm-content">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>

        </div>

        <!-- right block -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!-- Yandex direct -->
            <?= $this->render('/other/yandex-direct.php') ?>
        </div>

    </div>
</div>