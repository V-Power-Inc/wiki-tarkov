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

    <div class="owl-item" style="width:100%">
        <div style="width: 100%; max-width: 100%;">
            <!-- Виджет Twitch -->
            <div id="<enslaver_V>"></div>
        </div>
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
    
<!-- Вызов виджета Twitch -->
<script src= "https://player.twitch.tv/js/embed/v1.js"></script>
<script type="text/javascript">
    var options = {
        width: '100%',
        height: 367.14,
        channel: "<enslaver_V>",
    };
    var player = new Twitch.Player("<enslaver_V>", options);
    player.setVolume(0);
</script>

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
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="207" allowtransparency="true" frameborder="0"></iframe>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%94%D0%BE%D0%BD%D0%B0%D1%82%D1%8B%20%D0%BD%D0%B0%20%D1%80%D0%B0%D0%B7%D0%B2%D0%B8%D1%82%D0%B8%D0%B5%20tarkov-wiki.ru&targets-hint=&default-sum=&button-text=12&payment-type-choice=on&hint=&successURL=https%3A%2F%2Ftarkov-wiki.ru&quickpay=shop&account=410016162855090" width="450" height="213" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
                    </div>

                </div>
            </div>

            
        </div>
    </div>
</div>