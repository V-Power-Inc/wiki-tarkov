<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 25.01.2018
 * Time: 19:19
 */

use app\components\LeftmenuWidget;

$this->title = "Escape from Tarkov: $item->title";

$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/news.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading"><?= $item->title ?></h1>
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

            <div class="row">
                <!-- Итем из таблицы предметов -->
                <div class="col-lg-12">
                    <div class="item-loot">
                        
                        <a class="loot-link"><img class="loot-image" src="<?= $item->preview ?>"></a>
                        <p class="loot-description">
                            <?= $item->content ?>
                        </p>

                    </div>
                </div>
                <!-- Окончания итем из цикла -->
                
            </div>


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