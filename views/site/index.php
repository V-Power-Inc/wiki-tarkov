<?php

/* @var $this yii\web\View */
$this->registerJsFile('js/owl-init.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/owl-js/owl.carousel.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'База знаний Escape from Tarkov. Карты локаций, ключи от дверей, разбор квестов торговцев';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивные карты локаций, описания квестов торговцев и их прохождения, карта ключей от помещений.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Интерактивные карты локаций Escape from Tarkov, квесты Escape from Tarkov, Ключи Escape from Tarkov.',
]);
?>
<div class="owl-carousel owl-theme">


    <div class="owl-item">
        <img src="/img/slider/eft-2.jpg">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-1.jpg">
    </div>
    
    <div class="owl-item">
        <img src="/img/slider/eft-3.jpg">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-4.jpg">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-5.jpg">
    </div>
    
</div>

<div class="container padding-top-0">
    <div class="site-index">
    
        <div class="jumbotron jumbotron-main">
            <h1 class="margin-top-10">База знаний Escape from Tarkov</h1>
    
            <p class="lead">Здесь вы найдете информацию о важных аспектах внутриигрового процесса игры Escape from Tarkov. На сайте вы можете найти информацию о квестах торговцев, ключах от дверей и найти рекомендации по прохождению рейдов.</p>
    
            <p><a class="btn btn-lg btn-success main-inter-link mobile-display-none" href="/maps">Перейти к интерактивным картам Escape from Tarkov</a></p>
        </div>
    
        <div class="body-content">
    
            <div class="row">
                <div class="col-lg-4">
                    <h2>Задачи у торговцев</h2>
    
                    <p class="size-16">В этом разделе вы можете найти информацию о всех доступных квестах торговцев в Escape from Tarkov. Здесь собраны рекомендации по прохождению квестов, описания квестов, а также важные нюансы, которые являются неочевидными в процессе прохождения квестов Escape from Tarkov.</p>
    
                    <p><a class="btn btn-default main-link" href="/quests-of-traders">Перейти в раздел квестов EFT</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Ключи от дверей</h2>
    
                    <p class="size-16">В данном разделе - вы сможете найти информацию о любом ключе открывающим двери и помещения в Escape from Tarkov. Вы сможете увидеть где можно найти тот или иной ключ, как выглядят открываемые двери а также увидеть что находится внутри открытых вами помещений.</p>

                    <p><a class="btn btn-default main-link" href="/keys">Перейти в раздел ключей EFT</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Карты локаций</h2>
    
                    <p class="size-16">Здесь вы сможете воспользоваться интерактивными картами локаций Escape from Tarkov - воспользоваться поиском ключей, посмотреть как выглядят карты локаций, сделать пометки по прохождению рейда. Очень полезный инструмент, который пригодится всем игрокам Escape from Tarkov.</p>
    
                    <p><a class="btn btn-default main-link" href="/maps">Перейти к интерактивным картам EFT</a></p>
                </div>
            </div>
            
            
            <div class="margin-top-20">
                    
                <div class="row margin-top-20">

                    <div class="col-lg-12">
                        <!-- Виджет Вконтакте -->
                        <div class="vk-widget-styling">
                            <script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>

                            <!-- VK Widget -->
                            <div id="vk_groups"></div>
                            <script type="text/javascript">
                                VK.Widgets.Group("vk_groups", {mode: 3, width: "1140"}, 162698237);
                            </script>
                        </div>
                    </div>


                    <!-- Виджет Discord -->
                    
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">

                        <div class="margin-top-20">
                            <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="207" allowtransparency="true" frameborder="0"></iframe>
                        </div>

                        <script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>

                    </div>
                    
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <div style="margin-top: 11px;">
                            <?= $this->render('/other/yandex-donate.php'); ?>
                        </div>
                    </div>

                </div>
            </div>

            
        </div>
    </div>
</div>