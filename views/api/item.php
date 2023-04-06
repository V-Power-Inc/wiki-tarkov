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
use app\common\services\HighChartsService;
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

/** Объект класса для отображения данных графиков во вьюхе - если есть история цен на предмет, будет выводить графики */
$highChart = !empty($item->json['historicalPrices']) ? new HighChartsService($item->json['historicalPrices']) : '';

/** Подключаем попапы для картинок */
$this->registerJsFile('js/news.js', ['depends' => [JqueryAsset::class]]);
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
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 keys-content">

            <!-- Image block -->
            <div class="col-xs-3">

                <a class="image-link" title="<?= $item->name ?>" href="<?= $item->json['inspectImageLink'] ?>">
                    <img class="detail-item-image image-link" src="<?= $item->json['inspectImageLink'] ?>" alt="<?= $item->name ?>">
                </a>

            </div>

            <!-- Main content -->
            <div class="col-xs-9">

                <p class="title-of-item-block">Категория: <?= $item->json['category']['name'] ?></p>

                <p class="title-of-item-block">Описание: </p>

                <p class="size-16">Описание: <?=  $item->json['description'] ?? 'Отсутствует' ?></p>

                <p class="title-of-item-block">Можно купить: <?= !empty($item->json['buyFor']) ? '' : 'Нет' ?></p>

                <!-- buying -->
                <?php foreach($item->json['buyFor'] as $trader): ?>

                    <div class="selling-block row">

                        <div class="col-sm-2">
                            <img class="detail-item-trader" src="<?= ImageService::traderImages($trader['vendor']['name']) ?>" title="<?= $trader['vendor']['name'] ?>">
                        </div>

                        <div class="col-sm-10">
                            <p class="detail-item-trader-price">За: <?= $trader['price'] ?> <?= $trader['currency'] ?></p>

                            <!-- More info -->
                            <?= $trader['currency'] !== 'RUB' ? '<p class="detail-item-trader-price">В рублях: '. $trader['priceRUB'] .'</p>' : '' ?>

                        </div>

                    </div>
                <?php endforeach; ?>


                <p class="title-of-item-block">Можно продать: <?= !empty($item->json['sellFor']) ? '' : 'Нет' ?></p>

                <!-- sells -->
                <?php foreach($item->json['sellFor'] as $trader): ?>

                    <div class="selling-block row">

                        <div class="col-sm-2">
                            <img class="detail-item-trader" src="<?= ImageService::traderImages($trader['vendor']['name']) ?>" title="<?= $trader['vendor']['name'] ?>" alt="<?= $trader['vendor']['name'] ?>">
                        </div>

                        <div class="col-sm-10">
                            <p class="detail-item-trader-price">За: <?= $trader['price'] ?> <?= $trader['currency'] ?></p>

                            <!-- More info -->
                            <?= $trader['currency'] !== 'RUB' ? '<p class="detail-item-trader-price">В рублях: '. $trader['priceRUB'] .'</p>' : '' ?>

                        </div>

                    </div>
                <?php endforeach; ?>


                <p class="title-of-item-block">Можно выменять: <?= !empty($item->json['bartersFor']) ? '' : 'Нет' ?></p>

                <!-- barters block -->
                <?php foreach($item->json['bartersFor'] as $barter) : ?>

                    <div class="barters-block-actual row">

                        <div class="col-sm-2">
                            <img class="detail-item-trader" src="<?= ImageService::traderImages($barter['trader']['name']) ?>" title="<?= $barter['trader']['name'] ?>" alt="<?= $barter['trader']['name'] ?>">
                        </div>

                        <div class="col-sm-10">
                            <p class="detail-item-barter-info">Уровень: <?= $barter['level'] ?></p>

                            <p class="detail-item-barter-info">Требуются выполненные квесты: <?= !empty($barter['taskUnlock']) ? 'Да' : 'Нет' ?></p>

                            <p class="detail-item-barter-info">Для обмена нужны предметы:</p>

                            <!-- Required items - block -->
                            <?php foreach($barter['requiredItems'] as $req_item): ?>

                                <div class="barter-items-count">
                                    <span class="count-for-barter"> <b><?= $req_item['count'] ?>x</b></span> <img class="items-for-trade" src="<?= $req_item['item']['iconLink'] ?>" title="<?= $req_item['item']['name'] ?>" alt="<?= $req_item['item']['name'] ?>">
                                </div>

                            <?php endforeach; ?>

                        </div>

                    </div>

                <?php endforeach; ?>


                <p class="title-of-item-block">Можно получить в награду за задания: <?= !empty($item->json['receivedFromTasks']) ? '' : 'Нет' ?></p>

                <!-- Received for Quests -->
                <?php foreach($item->json['receivedFromTasks'] as $recieved): ?>

                <div class="received-block row">

                    <div class="col-sm-2">
                        <img class="detail-item-trader" src="<?= ImageService::traderImages($recieved['trader']['name']) ?>" title="<?= $recieved['trader']['name'] ?>" alt="<?= $recieved['trader']['name'] ?>">
                    </div>

                    <div class="col-sm-10">
                        <p class="detail-item-barter-info">Выдает за выполнение: <b><?= $recieved['name'] ?></b></p>
                    </div>

                </div>


                <?php endforeach; ?>


                <?php if (!empty($item->json['historicalPrices'])): ?>

                    <!-- История цен на предмет -->
                    <div class="row received-block">
                        <div class="col-sm-12">
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
                                        'categories' => $highChart->dates,
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
                                            'data' => $highChart->prices,
                                            'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "orange"')
                                        ],
                                    ]
                                ]
                            ]) ?>
                        </div>
                    </div>
                <?php endif; ?>


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

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php') ?>

            <!-- Виджет Вконтакте -->
            <div class="vk-widget-styling">
                <?= $this->render('/other/wk-widget'); ?>
            </div>

            <br>

            <!-- Виджет дискорда -->
            <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                <?= $this->render('/other/discord-widget.php'); ?>
            <?php  $this->endCache(); } ?>
        </div>

    </div>
</div>