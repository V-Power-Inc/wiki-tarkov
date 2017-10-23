<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.10.2017
 * Time: 15:15
 */
$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Квесты Прапора в Escape from Tarkov. Разбор и прохождение квестов Прапора.';
?>
<div class="heading-class">
    <div class="container">
        <h1 class="trader-heading">Квесты Прапора</h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <ul class="nav nav-list bs-docs-sidenav">
                <li><a data-toggle="tab" href="#1" class="relative"><i class="fa fa-chevron-right"></i> Квесты</a></li>
                <li><a data-toggle="tab" href="#2" class="relative"><i class="fa fa-chevron-right"></i> Группы кнопок</a></li>
                <li><a data-toggle="tab" href="#3" class="relative"><i class="fa fa-chevron-right"></i> Выпадающие списки кнопок</a></li>
                <li><a data-toggle="tab" href="#4" class="relative"><i class="fa fa-chevron-right"></i> Навигация</a></li>
                <li><a data-toggle="tab" href="#5" class="relative"><i class="fa fa-chevron-right"></i> Панель навигации</a></li>
                <li><a data-toggle="tab" href="#6" class="relative"><i class="fa fa-chevron-right"></i> Навигационные цепочки («Хлебные крошки»)</a></li>
                <li><a data-toggle="tab" href="#7" class="relative"><i class="fa fa-chevron-right"></i> Разбиение на страницы</a></li>
                <li><a data-toggle="tab" href="#8" class="relative"><i class="fa fa-chevron-right"></i> Ярлыки и бейджи</a></li>
                <li><a data-toggle="tab" href="#9" class="relative"><i class="fa fa-chevron-right"></i> Оформление</a></li>
                <li><a data-toggle="tab" href="#10" class="relative"><i class="fa fa-chevron-right"></i> Миниатюры</a></li>
                <li><a data-toggle="tab" href="#11" class="relative"><i class="fa fa-chevron-right"></i> Сообщения</a></li>
                <li><a data-toggle="tab" href="#12" class="relative"><i class="fa fa-chevron-right"></i> Индикатор процесса</a></li>
                <li><a data-toggle="tab" href="#13" class="relative"><i class="fa fa-chevron-right"></i> Дополнительно</a></li>
            </ul>
            
            
        </div>



        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="info-quests" id="info-alert-prapor" style="display: none;">
                <p class="alert alert-info sm-vertical-margin-20 size-16">Квесты Прапора вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.</p>
                <img class="torgovec-info-quest-image" src="/img/torgovcy/prapor-quests/prapor-full.jpg">
            </div>
                <div class="tab-content">
                    <div id="1" class="tab-pane fade">
                        <p>1</p>
                    </div>
        
                    <div id="2" class="tab-pane fade">
                        <p>2</p>
                    </div>
        
                    <div id="3" class="tab-pane fade">
                        <p>3</p>
                    </div>
        
                    <div id="4" class="tab-pane fade">
                        <p>4</p>
                    </div>
        
                    <div id="5" class="tab-pane fade">
                        <p>5</p>
                    </div>
        
                    <div id="6" class="tab-pane fade">
                        <p>6</p>
                    </div>
        
                    <div id="7" class="tab-pane fade">
                        <p>7</p>
                    </div>
        
                    <div id="8" class="tab-pane fade">
                        <p>8</p>
                    </div>
        
                    <div id="9" class="tab-pane fade">
                        <p>9</p>
                    </div>
        
                    <div id="10" class="tab-pane fade">
                        <p>10</p>
                    </div>
        
                    <div id="11" class="tab-pane fade">
                        <p>11</p>
                    </div>
        
                    <div id="12" class="tab-pane fade">
                        <p>12</p>
                    </div>
        
                    <div id="13" class="tab-pane fade">
                        <p>13</p>
                    </div>
                </div>




        </div>
    </div>
</div>

