<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 08.06.2022
 * Time: 18:08
 */

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/map_hash.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/rezerv-location.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->title = 'Карта локации Резерв в Escape from Tarkov';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации Резерв из игры Escape from Tarkov',
]);

use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\web\JsExpression;

?>


<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации Резерв</h1>
    </div>
</div>

<!-- Инициализация карты -->
<div class="w-100">
    <div id="map" class="map relative">

        <!-- Координаты мышки -->
        <div id="mapCoords" data-original-title="" title=""></div>
        <!-- Кнопка вернуться к центру -->
        <p class="mapcenter"><a class="btn btn-default main-link">Вернуться к центру карты</a></p>
    </div>
</div>

<!-- Опции карты -->
<div class="optins_layerstability">

    <div class="outer-button"><img src="/img/maps/button_outer.png"></div>
    <div class="inner-button"><img src="/img/maps/button_inner.png"></div>

    <div class="col-lg-12">
        <div class="option-buttons">


        </div>
        <!-- Контент страницы -->
        <div class="col-lg-12">

            <div class="static-description">

                <div class="search-map-loot">
                    <?php
                    // Defines a custom template with a <code>Handlebars</code> compiler for rendering suggestions
                    echo '<label class="control-label">Поиск лута</label>';
                    $template = '<div class="ajax-result"><a href="/loot/{{url}}.html" target="_blank"><img src="{{preview}}" class="ajax-image-preview">'.
                        '<p class="repo-language ajax-preview-title">{{title}}</p>' .
                        '<!--p class="repo-name">{{category}}</p> -->' .
                        '<p class="repo-description black"><b>Находится в категории: {{parentcat_id}}</b></p></a></div>';

                    $keystemp = '<div class="ajax-result"><a href="/keys/{{url}}" target="_blank"><img src="{{preview}}" class="ajax-image-preview">'.
                        '<p class="repo-language ajax-preview-title">{{name}}</p>' .
                        '<p class="repo-description black"><b>Находится в категориях: {{mapgroup}}</b></p></a></div>';
                    echo Typeahead::widget([
                        'name' => 'items',
                        'scrollable' => true,
                        'options' => ['placeholder' => 'Введите сюда название предмета'],
                        'pluginOptions' => ['hint' => false, 'highlight' => true],
                        'dataset' => [
                            [
                                'remote' => [
                                    'url' => Url::to(['loot/lootjson']) . '?q=%QUERY',
                                    'wildcard' => '%QUERY',
                                ],
                                'limit' => 50,
                                'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                                'display' => 'value',
                                'templates' => [
                                    //  'notFound' => '<div class="text-danger" style="padding:0 8px">Подходящий лут не найден.</div>',
                                    'suggestion' => new JsExpression("Handlebars.compile('{$template}')")
                                ]
                            ],
                            [
                                'remote' => [
                                    'url' => Url::to(['site/keysjson']) . '?q=%QUERY',
                                    'wildcard' => '%QUERY',
                                ],
                                'limit' => 50,
                                'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                                'display' => 'value',
                                'templates' => [
                                    //  'notFound' => '<div class="text-danger" style="padding:0 8px">Подходящие ключи от дверей не найдены.</div>',
                                    'suggestion' => new JsExpression("Handlebars.compile('{$keystemp}')")
                                ]
                            ]
                        ],
                    ]);
                    ?>
                </div>

                <h2>Интерактивная карта локации Резерв</h2>
                <p class="maps-mobile-hidden-value">Интерактивная карта локации Резерв из Escape from Tarkov - на данной карте, вы сможете увидеть спавны и выходы за диких и ЧВК с локации лаборатория Terra Group, узнать о местонахождении оружейных и военных ящиков. </p>
                <p class="maps-mobile-hidden-value"></p>
                <div class="maps-mobile-hidden-value">
                    <?= $this->render('/other/yandex-direct-bottom-intermaps'); ?>
                </div>
            </div>

        </div>
    </div>
</div>