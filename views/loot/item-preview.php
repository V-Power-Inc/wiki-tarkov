<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 06.07.2018
 * Time: 10:47
 */

use yii\web\JqueryAsset;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\web\JsExpression;
use app\components\LeftmenuWidget;
use app\models\Items;

/* @var Items $item - AR объект предмета справочника лута */

$this->title = 'Предпросмотр: '.$item->title;

$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/news.js', ['depends' => [JqueryAsset::class]]);
?>
<style>
    img.image-link {
        border: 1px solid white;
        box-shadow: 1px 1px 6px 2px;
    }
</style>

<div class="container">
    <div class="row">

        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <ul class="nav nav-pills nav-stacked categories categories-menu" id="categories-menu">
                <?= LeftmenuWidget::widget(['tpl' => 'leftmenu']) ?>
            </ul>

            <br>

            <p><a class="btn btn-default main-link" href="/loot/quest-loot" style="width: 100%;">Квестовые предметы</a></p>
        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">

            <div class="row">
                <!-- Итем из таблицы предметов -->
                <div class="col-lg-12">

                    <div class="top-content">
                        <!-- ajax поиск предметов в справочнике лута -->

                        <?php
                        // Defines a custom template with a <code>Handlebars</code> compiler for rendering suggestions
                        echo '<label class="control-label">Поиск предметов в справочнике по названию</label>';
                        $template = '<div class="ajax-result"><a href="/loot/{{url}}.html"><img src="{{preview}}" class="ajax-image-preview">'.
                            '<p class="repo-language ajax-preview-title">{{title}}</p>' .
                            '<!--p class="repo-name">{{category}}</p> -->' .
                            '<p class="repo-description black"><b>Находится в категории: {{parentcat_id}}</b></p></a></div>';

                        $keystemp = '<div class="ajax-result"><a href="/keys/{{url}}"><img src="{{preview}}" class="ajax-image-preview">'.
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

                    <div class="item-loot">

                        <a class="loot-link"><img class="loot-image" alt="<?= $item->title ?>" src="<?= $item->preview ?>"></a>
                        <p class="loot-description">
                            <?= $item->content ?>
                        </p>
                        <p class="text-right"><a class="btn btn-default main-link" onclick="javascript:history.back(); return false;">Вернуться на предыдущую страницу</a></p>
                    </div>
                </div>
                <!-- Окончания итем из цикла -->

            </div>


        </div>

    </div>
</div>