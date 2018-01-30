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

            <!-- Виджет Discord -->
            <div class="margin-top-20">
                <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
            </div>
        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">
            
            <!-- Описание категории -->
            <p class="alert alert-info size-16"><?= $model['content'] ?></p>

            <!-- Цикл предметов категории -->
            <?php if(!empty($items)) : ?>
                <?php foreach ($items as $item) : ?>
                    <div class="col-lg-12">
                        <div class="item-loot">
                            <h2 class="item-loot-title"><a href="<?= yii\helpers\Url::to(['item/detailloot' ,'id' => $item['id']]) ?>"><?= $item['title'] ?></a></h2>
                            <a class="loot-link" href="<?= yii\helpers\Url::to(['item/detailloot' ,'id' => $item['id']]) ?>"><img class="loot-image" src="<?= $item['preview'] ?>"></a>
                            <p class="loot-description"><?= $item['shortdesc'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
            <div class="col-lg-12">
                <p class="alert alert-danger size-16">В данный момент в разделе нет лута.</p>
            </div>
            <?php endif; ?>
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