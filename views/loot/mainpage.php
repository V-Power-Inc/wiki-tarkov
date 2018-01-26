<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 25.01.2018
 * Time: 19:19
 */

$this->title = "Справочник лута Escape from Tarkov. База внутриигровых предметов.";

$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <ul class="nav nav-pills nav-stacked categories categories-menu" id="categories-menu">
                <li class="relative active"><a href="#">Оружие</a></li>
                <li class="relative">
                    <a href="#">Экипировка</a>
                    <div class="dcjq-icon">&nbsp;&nbsp;&nbsp;</div>
                        <!-- Подкатегории меню -->
                        <ul class="children-cats">
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Военное снаряжение</a></li>
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Обвесы</a></li>
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Ранцы</a></li>
                        </ul>
                        <!-- Окончание подкатегорий -->
                </li>

                <li class="relative"><a href="#">Медицина</a></li>
                <li class="relative"><a href="#">Квестовые предметы</a></li>
                <li class="relative"><a href="#">Пища</a></li>
                <li class="relative">
                    <a href="#">Хлам</a>
                    <div class="dcjq-icon">&nbsp;&nbsp;&nbsp;</div>
                        <!-- Подкатегории меню -->
                        <ul class="children-cats">
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Подкатегория 1</a></li>
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Подкатегория 2</a></li>
                            <li class="level-2"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="#">Подкатегория 3</a></li>
                        </ul>
                        <!-- Окончание подкатегорий -->
                </li>

            </ul>
        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">
           <p class="alert alert-info size-16">На этой странице вы можете узнать информацию о любом луте из игры Escape from Tarkov. В справочнике вы сможете найти информацию о любом внутриигровом предмете. <br><br>
           Для удобства была создана разбивка по категориям, что облегчит вам поиск наиболее интересных предметов.</p>
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
