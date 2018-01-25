<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 25.01.2018
 * Time: 19:19
 */

$this->title = "Справочник лута Escape from Tarkov. База внутриигровых предметов.";

$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Справочник лута Escape from Tarkov</h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <ul class="nav nav-pills nav-stacked categories">
                <li class="relative active"><a href="#">Оружие</a></li>
                <li class="relative">
                    <a href="#">Экипировка</a>
                    <i class="fa fa-plus categories-abs" aria-hidden="true"></i>
                        <!-- Подкатегории меню -->
                        <li class="level-2"><a href="#">Подкатегория 1</a></li>
                        <li class="level-2"><a href="#">Подкатегория 2</a></li>
                        <li class="level-2"><a href="#">Подкатегория 3</a></li>
                </li>
                <li class="relative"><a href="#">Медицина</a></li>
                <li class="relative"><a href="#">Квестовые предметы</a></li>
                <li><a href="#">Пища</a></li>
                <li><a href="#">Хлам</a></li>
            </ul>
        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">
           
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
