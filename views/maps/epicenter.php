<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.03.2024
 * Time: 16:04
 */

use app\common\services\CanonicalPagesService;
use yii\helpers\Url;
use yii\web\JqueryAsset;

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/map_hash.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/epicenter-location.js?v=6.8.27', ['depends' => [JqueryAsset::class]]);
$this->title = 'Карта локации Эпицентр в Escape from Tarkov.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Эпицентр из игры Escape from Tarkov.',
]);

/** Редирект для неканоничных страниц локаций (Убираем дубли из поисковых систем) */
CanonicalPagesService::redirectToCanonical(Url::canonical(), Yii::$app->request->url);
?>


<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации Эпицентр</h1>
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