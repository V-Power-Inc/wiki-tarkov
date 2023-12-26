<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 08.06.2022
 * Time: 18:36
 */

use app\common\services\CanonicalPagesService;
use yii\helpers\Url;

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/map_hash.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/lighthouse-location.js?v=6.5.24', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->title = 'Карта локации Маяк в Escape from Tarkov.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Маяк из игры Escape from Tarkov.',
]);

/** Редирект для неканоничных страниц локаций (Убираем дубли из поисковых систем) */
CanonicalPagesService::redirectToCanonical(Url::canonical(), Yii::$app->request->url);
?>


<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации Маяк</h1>
    </div>
</div>

<!-- Gorizontal information -->
<div class="container special-padding">
    <div class="row">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>

<hr class="grey-line">

<!-- Инициализация карты -->
<div class="w-100">
    <div id="map" class="map relative">

        <!-- Координаты мышки -->
        <div id="mapCoords" data-original-title="" title=""></div>
        <!-- Кнопка вернуться к центру -->
        <p class="mapcenter"><a class="btn btn-default main-link">Вернуться к центру карты</a></p>
    </div>
</div>