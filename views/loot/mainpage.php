<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 25.01.2018
 * Time: 19:19
 */

use yii\web\JqueryAsset;
use app\components\LeftmenuWidget;
use yii\widgets\LinkPager;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\web\JsExpression;
use app\models\Items;

/** @var Items[] $items - массив AR объектов справочника лута */

$this->title = "Справочник лута Escape from Tarkov. База внутриигровых предметов.";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Полная база лута по Escape from Tarkov - контент постоянно актуализируется',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Escape from Tarkov: Полная база данных лута',
]);

$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/fix-img-blocks.js', ['depends' => [JqueryAsset::class]]);
?>
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>
        
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <ul class="nav nav-pills nav-stacked categories categories-menu" id="categories-menu">
            <?= LeftmenuWidget::widget(['tpl' => 'leftmenu']) ?>
            </ul>

            <br>

            <p><a class="btn btn-default main-link" href="/loot/quest-loot" style="width: 100%;">Квестовые предметы</a></p>

            <!-- Виджет Вконтакте - Был тут ранее -->
            <div class="vk-widget-styling"></div>

            <!-- Виджет Discord - Был тут ранее -->
            <div class="margin-top-20"></div>

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">
         <div class="top-content">
           <p class="alert alert-info size-16 margin-top-20">На этой странице вы можете узнать информацию о любом луте из игры Escape from Tarkov. В справочнике вы сможете найти информацию о любом внутриигровом предмете. <br><br>
           Для удобства была создана разбивка по категориям, что облегчит вам поиск наиболее интересных предметов.<br><br>
           В категории c оружием вы сможете найти всю информацию о таких редких винтовках как ВСС Вал или ДВЛ-10, а также узнать немало нового о тех видах вооружения, о которых вы уже наслышаны. <br><br>
           Используйте наш умный поиск предметов, для того чтобы быстро найти то что вас интересует, также через этот поиск вы можете искать <b>ключи от дверей</b>.</p>
            
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
            
            <div class="row">
                <!-- Цикл всех предметов из справочника -->

                <?php if(empty($items)) : ?>
                    <!-- Нет лута -->
                    <div class="col-lg-12">
                        <p class="alert alert-danger size-16">В данный момент в справочнике нет лута.</p>
                    </div>
                    <!-- Нет лута -->
                <?php else : ?>

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
                                    <img class="loot-image" alt="название предмета" src="<?= $v[Items::ATTR_PREVIEW] ?>">
                                </div>
                            </a>
                            <p class="loot-description"><?= $v[Items::ATTR_SHORTDESC] ?></p>
                            <?php if($v[Items::ATTR_QUEST_ITEM] == Items::TRUE) : ?>
                                <p class="alert alert-danger size-16 custom-margin-top"><b>Этот предмет необходим для выполнения квеста.</b></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <!-- Окончание цикла -->

                    <div class="col-lg-12 pagination text-center">
                        <?= LinkPager::widget([
                            'pagination' => $pagination,
                        ]);
                        ?>
                    </div>
                <?php endif; ?>
                
            </div>

            <div class="recommended-gm-content">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Расстояние - заглушка -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>

            <!-- Комментарии -->
            <?php if(empty($_GET)) : ?>
                <?= $this->render('/other/comments');?>
            <?php endif; ?>

        </div>

    </div>
</div>