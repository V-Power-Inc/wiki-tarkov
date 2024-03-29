<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 28.01.2018
 * Time: 0:17
 */

use yii\web\JqueryAsset;
use app\components\LeftmenuWidget;
use yii\widgets\LinkPager;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\web\JsExpression;
use app\models\Category;
use app\models\Items;

/* @var Category $cat - AR объект категории справочника лута */

$this->title = "Escape from Tarkov: " . $cat[Category::ATTR_TITLE];

$this->registerMetaTag([
    'name' => 'description',
    'content' => $cat[Category::ATTR_DESCRIPTION],
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $cat[Category::ATTR_KEYWORDS],
]);

/******** OpenGraph теги ************/

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $cat[Category::ATTR_TITLE],
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . Yii::$app->request->url,
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $cat[Category::ATTR_DESCRIPTION],
]);

$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/fix-img-blocks.js', ['depends' => [JqueryAsset::class]]);
?>
<div class="container">
    <div class="row">

        <?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles'): ?>
            <!-- no-scale -->
            <div class="col-lg-12">
                <?= $this->render('/other/google-gor.php'); ?>
            </div>
        <?php endif; ?>
        
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <ul class="nav nav-pills nav-stacked categories categories-menu" id="categories-menu">
                <?= LeftmenuWidget::widget(['tpl' => 'leftmenu']) ?>
            </ul>

            <br>

            <p><a class="btn btn-default main-link" href="/loot/quest-loot" style="width: 100%;">Квестовые предметы</a></p>

            <?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles'): ?>
                <!--Yandex direct -->
                <?= $this->render('/other/yandex-direct.php'); ?>
            <?php endif; ?>
        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">
            <div class="top-content">
            <!-- Описание категории -->
            <p class="alert alert-info size-16"><?= $cat->content ?></p>

                <!-- ajax поиск предметов в справочнике лута -->
                <?php
                // Defines a custom template with a <code>Handlebars</code> compiler for rendering suggestions
                echo '<label class="control-label">Поиск предметов в справочнике по названию</label>';
                $template = '<div class="ajax-result"><a href="/loot/{{url}}.html"><img src="{{preview}}" class="ajax-image-preview">'.
                    '<p class="repo-language ajax-preview-title">{{title}}</p>' .
                    '<!--p class="repo-name">{{category}}</p> -->' .
                    '<p class="repo-description black"><b>Находится в категории: {{parentcat_id}}</b></p></a></div>';

                $keys = '<div class="ajax-result"><a href="/keys/{{url}}"><img src="{{preview}}" class="ajax-image-preview">'.
                    '<p class="repo-language ajax-preview-title keydoors">{{name}}</p>' .
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
                                'suggestion' => new JsExpression("Handlebars.compile('{$keys}')")
                            ]
                        ]
                    ],
                ]);
                ?>
            </div>

            
        <div class="row">
                <?php if(empty($items)) : ?>
                    <!-- Нет лута -->
                    <div class="col-lg-12">
                        <p class="alert alert-danger size-16">В данный момент в разделе нет лута.</p>
                    </div>
                    <!-- Нет лута -->
                <?php else : ?>

                <!-- Цикл предметов категории -->
                    <?php foreach($items as $item => $v): ?>

                        <?php if(in_array($item,Yii::$app->params['keysBlocks'])): ?>
                            <div class="col-lg-12 fixible-block">
                                <div class="item-loot h-130">
                                    <?= $this->render('/other/adsense-feed.php'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a href="/loot/<?= $v[Items::ATTR_URL] ?>.html"><?= $v[Items::ATTR_TITLE] ?></a></h2>
                                <a class="loot-link" href="/loot/<?= $v[Items::ATTR_URL] ?>.html">
                                    <div class="fixies-float-image">
                                        <img class="loot-image" alt="<?= $v[Items::ATTR_TITLE] ?>" src="<?= $v[Items::ATTR_PREVIEW] ?>">
                                    </div>
                                </a>
                                <p class="loot-description"><?= $v[Items::ATTR_SHORTDESC] ?></p>
                                <?php if($v[Items::ATTR_QUEST_ITEM] == Items::TRUE) : ?>
                                <p class="alert alert-danger size-16 custom-margin-top"><b>Этот предмет необходим для выполнения квеста.</b></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- Окончание цикла предметов -->

                        <div class="col-lg-12 pagination text-center">
                            <?= LinkPager::widget([
                                'pagination' => $pagination,
                                'firstPageLabel' => 'первая',
                                'lastPageLabel' => 'последняя',
                                'prevPageLabel' => '&laquo;',
                                'prevPageLabel' => '&laquo;',
                            ]);
                            ?>
                        </div>
                <?php endif; ?>


                <?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles'): ?>
                    <div class="recommended-gm-content">
                        <?= $this->render('/other/google-recommended.php'); ?>
                    </div>
                <?php endif; ?>

                <!-- Расстояние - заглушка -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>

                <!-- Комментарии -->
                <?php if(empty($_GET)) : ?>
                    <?= $this->render('/other/comments');?>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>