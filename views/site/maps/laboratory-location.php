<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 26.12.2018
 * Time: 21:46
 */

$this->registerCssFile("js/leaflet/leaflet.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/leaflet/leaflet.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/map_hash.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/laboratory-location.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Карта локации лаборатория Terra Group в Escape from Tarkov - интерактивная карта со спавнами Диких, точками военных ящиков и ключей';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивная карта локации лаборатория Terra Group из игры Escape from Tarkov с маркерами расположения военных ящиков, спавнов диких и ЧВК, дверей открываемых ключами.',
]);

use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\web\JsExpression;

?>


<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<div class="heading-class mappage">
    <div class="container">
        <h1 class="main-site-heading">Карта локации лаборатория Terra Group</h1>
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


<!-- todo: Включить когда выйдет продакшен -->
    <div class="col-lg-12">
        <div class="option-buttons">
            <h2 class="map-title">Маркеры</h2>
<!--                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">-->
<!--                    <p class="dikie-b" id="dikie-spawns-bereg"><i class="dikie-spawns"></i>Спавны диких</p>-->
<!--                    <p class="gamers-b" id="chvk-spawns-bereg"><i class="chvk-spawns"></i>Спавны ЧВК</p>-->
<!--                    <p class="bandits-b" id="dikie-exits-bereg"><i class="dikie-exits"></i>Выходы с карты за Диких</p>-->
<!--                    <p class="exits-b" id="chvk-exits-bereg"><i class="chvk-exits"></i>Выходы с карты за ЧВК</p>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">-->
<!--                    <p class="voenka-b" id="weapons-bereg"><i class="weapon-cases"></i>Оружейные ящики</p>-->
<!--                    <p class="polki-b" id="quests-bereg"><i class="quest-tochki"></i>Квестовые точки</p>-->
<!--                    <p class="w-100 keys-b" id="doors-bereg"><i class="doors-tochki"></i>Открываемые двери</p>-->
<!--                    <p class="w-100 places-b" id="interesting-places-bereg"><i class="interest-tochki"></i>Интересные места</p>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">-->
<!--                    <p class="count-on" id="bereg-count-on"><i class="fa fa-check-square" aria-hidden="true"></i>Показать количество маркеров</p>-->
<!--                    <p class="markers-on">Показать все маркеры<i class="fa fa-eye"></i></p>-->
<!--                </div>-->
<!---->
<!--                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map_buttons">-->
<!--                    <p class="count-off" id="bereg-count-off"><i class="fa fa-square" aria-hidden="true"></i>Скрыть количество маркеров</p>-->
<!--                    <p class="markers-off"><i class="fa fa-eye-slash"></i>Скрыть все маркеры</p>-->
<!--                </div>-->

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

                <h2>Интерактивная карта локации лаборатория Terra Group</h2>
                <p>Интерактивная карта локации лаборатория Terra Group из Escape from Tarkov - на данной карте, вы сможете увидеть спавны и выходы за диких и ЧВК с локации лаборатория Terra Group, узнать о местонахождении оружейных и военных ящиков. </p>
                <p>Также с помощью интерактивной карты вы сможете узнать о местах спавна ключей от помещений и сейфов, которые спавнятся на карте лаборатории Terra Group. Интерактивная карта локации лаборатория Terra Group поможет вам очень быстро найти квестовые точки, на которых можно увидеть предметы, или места необходимые для выполнения квестов торговцев.</p>
                <p>В отличие от других карт - локация Terra Group разделена на несколько этажей или секторов, что делает ее довольно необычной и неповторимой, эта схема будет полезная игрокам ЧВК и диким, которые хотят выбраться из лаборатории живыми.</p>
                <p class="alert alert-danger"><b>Ожидаем появления официальной карты.</b></p>
                <p></p>
                <?= $this->render('/other/google-gor.php'); ?>
            </div>

        </div>
    </div>
</div>