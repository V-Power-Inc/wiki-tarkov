<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 28.01.2018
 * Time: 0:17
 */

use app\components\LeftmenuWidget;
use yii\widgets\LinkPager;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use Yii;

$this->title = "Escape from Tarkov: " . $cat['title'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => $cat['description'],
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $cat['keywords'],
]);

/******** OpenGraph теги ************/

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $cat['title'],
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => 'https://tarkov-wiki.ru'. Yii::$app->request->url,
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $cat['description'],
]);


$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

use app\components\AlertComponent;
?>
<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading"><?= $cat->title ?></h1>
    </div>
</div>



<hr class="grey-line">

<?php if((AlertComponent::alert()->enabled !== 0)) : ?>
    <!-- Информационная строка -->
    <div class="row">
        <div class="container">
            <div class="col-lg-12 <?= AlertComponent::alert()->bgstyle ?>">
                <marquee style="font-size: 16px; color: white; font-weight: bold; margin-top: 4px;"><?= AlertComponent::alert()->content ?></marquee>
            </div>
        </div>
    </div>
    <hr class="grey-line">
<?php endif; ?>

<div class="container">
    <div class="row">
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <ul class="nav nav-pills nav-stacked categories categories-menu" id="categories-menu">
                <?= LeftmenuWidget::widget(['tpl' => 'leftmenu']) ?>
            </ul>

            <br>

            <p><a class="btn btn-default main-link" href="/loot/quest-loot" style="width: 100%;">Квестовые предметы</a></p>
            
            <!-- Виджет Discord -->
            <div class="margin-top-20">
                <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
            </div>
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
                <?php foreach ($items as $item) : ?>
                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a href="/loot/<?= $item['url'] ?>.html"><?= $item['title'] ?></a></h2>
                                <a class="loot-link" href="/loot/<?= $item['url'] ?>.html"><img class="loot-image" alt="<?= $item['title'] ?>" src="<?= $item['preview'] ?>"></a>
                                <p class="loot-description"><?= $item['shortdesc'] ?></p>
                                <?php if($item['quest_item'] == 1) : ?>
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
            </div>
        </div>

        <!-- Расстояние - заглушка -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>

        <!-- Комментарии -->
        <?php if(empty($_GET)) : ?>
            <div id="mc-container" class="kek-recustom"></div>
            <script type="text/javascript">
                cackle_widget = window.cackle_widget || [];
                cackle_widget.push({widget: 'Comment', id: 57165});
                (function() {
                    var mc = document.createElement('script');
                    mc.type = 'text/javascript';
                    mc.async = true;
                    mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
                })();
            </script>
        <?php endif; ?>

    </div>
</div>