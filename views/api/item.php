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

$this->title = 'Предмет: ' . $item->name .' в Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Информация о характеристиках, покупке и продаже ' . $item->name . ' в Escape from Tarkov'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Escape From Tarkov, лут, ' . $item->name
]);

use app\models\ApiLoot;
use yii\helpers\Json;
use yii\web\JqueryAsset;
use app\common\services\ImageService;

/** Декоридуем Json */
$item->json = Json::decode($item->json);

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
            <div class="col-xs-4">

                <a class="image-link" title="<?= $item->name ?>" href="<?= $item->json['inspectImageLink'] ?>">
                    <img class="detail-item-image image-link" src="<?= $item->json['inspectImageLink'] ?>" alt="<?= $item->name ?>">
                </a>

            </div>

            <!-- Main content -->
            <div class="col-xs-8">
                <p class="size-16 detail-item-text">Описание: <?=  $item->json['description'] ?? 'Отсутствует' ?></p>

                <p class="size-16 detail-item-text">Можно купить:</p>

                <!-- buying -->
                <?php foreach($item->json['buyFor'] as $trader): ?>

                    <div class="selling-block row">

                        <div class="col-sm-3">
                            <img class="detail-item-trader" src="<?= ImageService::traderImages($trader['vendor']['name']) ?>" title="<?= $trader['vendor']['name'] ?>">
                        </div>

                        <div class="col-sm-9">
                            <p class="detail-item-trader-price">За: <?= $trader['price'] ?> <?= $trader['currency'] ?></p>

                            <!-- More info -->
                            <?= $trader['currency'] !== 'RUB' ? '<p class="detail-item-trader-price">В рублях: '. $trader['priceRUB'] .'</p>' : '' ?>

                        </div>

                    </div>
                <?php endforeach; ?>


                <p class="size-16 detail-item-text">Можно продать:</p>

                <!-- sells -->
                <?php foreach($item->json['sellFor'] as $trader): ?>

                    <div class="selling-block row">

                        <div class="col-sm-3">
                            <img class="detail-item-trader" src="<?= ImageService::traderImages($trader['vendor']['name']) ?>" title="<?= $trader['vendor']['name'] ?>">
                        </div>

                        <div class="col-sm-9">
                            <p class="detail-item-trader-price">За: <?= $trader['price'] ?> <?= $trader['currency'] ?></p>

                            <!-- More info -->
                            <?= $trader['currency'] !== 'RUB' ? '<p class="detail-item-trader-price">В рублях: '. $trader['priceRUB'] .'</p>' : '' ?>

                        </div>

                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- right block -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <!-- $this->render('/other/yandex-direct.php'); -->

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
