<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 28.01.2018
 * Time: 0:17
 */

use app\components\LeftmenuWidget;

$this->title = $model['title'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model['description'],
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model['keywords'],
]);

/******** OpenGraph теги ************/

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $model['title'],
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => 'https://tarkov-wiki.ru'. Yii::$app->request->url,
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $model['description'],
]);

$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading"><?= $model['title'] ?></h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <ul class="nav nav-pills nav-stacked categories categories-menu" id="categories-menu">
                <?= LeftmenuWidget::widget(['tpl' => 'leftmenu']) ?>
            </ul>
        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">
                    <!-- Тут будут циклы из предметов этой категории -->
        </div>

        <!-- Расстояние - заглушка -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>

        <!-- Комментарии -->
        <!--     <div id="mc-container" class="kek-recustom"></div>
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
        -->

    </div>
</div>