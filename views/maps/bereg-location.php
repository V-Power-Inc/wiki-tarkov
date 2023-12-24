<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.12.2017
 * Time: 18:23
 */

use app\common\services\CanonicalPagesService;
use yii\helpers\Url;
use yii\web\JqueryAsset;

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/map_hash.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/bereg-location.js?v=6.1.12', ['depends' => [JqueryAsset::class]]);

$this->title = 'Карта локации Берег в Escape from Tarkov - интерактивная карта со спавнами Диких, точками военных ящиков и ключей';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Берег из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, дверей открываемых ключами.',
]);

/** Редирект для неканоничных страниц локаций (Убираем дубли из поисковых систем) */
CanonicalPagesService::redirectToCanonical(Url::canonical(), Yii::$app->request->url);
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации Берег</h1>
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
    <div id="map" class="map">
        <!-- Координаты мышки -->
        <div id="mapCoords" data-original-title="" title=""></div>
        <!-- Кнопка вернуться к центру -->
        <p class="mapcenter"><a class="btn btn-default main-link">Вернуться к центру карты</a></p>
    </div>
</div>