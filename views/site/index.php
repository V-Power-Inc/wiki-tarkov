<?php

use yii\web\JqueryAsset;

/* @var $this yii\web\View */
$this->registerJsFile('js/owl-init.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/owl-js/owl.carousel.js', ['depends' => [JqueryAsset::class]]);
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
        <img src="/img/slider/eft-2.jpg" alt="Escape from Tarkov: Игровые скриншоты">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-1.jpg" alt="Escape from Tarkov: Игровые скриншоты">
    </div>
    
    <div class="owl-item">
        <img src="/img/slider/eft-3.jpg" alt="Escape from Tarkov: Игровые скриншоты">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-4.jpg" alt="Escape from Tarkov: Игровые скриншоты">
    </div>

    <div class="owl-item">
        <img src="/img/slider/eft-5.jpg" alt="Escape from Tarkov: Игровые скриншоты">
    </div>
    
</div>

<div class="container padding-top-0">
    <div class="site-index">
    
        <div class="jumbotron jumbotron-main">
            <h1 class="margin-top-10">База знаний Escape from Tarkov</h1>
    
            <p class="lead">Здесь вы найдете информацию о важных аспектах внутриигрового процесса игры Escape from Tarkov. На сайте вы можете найти информацию о квестах торговцев, ключах от дверей и найти рекомендации по прохождению рейдов.</p>
    
            <p><a class="btn btn-lg btn-success main-inter-link mobile-display-none" href="/maps">Перейти к интерактивным картам Escape from Tarkov</a></p>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-adb">
            <?= $this->render('/other/yandex-direct-mainpage.php'); ?>
        </div>
    
        <div class="body-content">
    
            <div class="row">
                <div class="col-lg-4">
                    <h2>Задачи у торговцев</h2>

                    <a href="/quests-of-traders">
                        <img class="preview-mainpage-desc" src="/img/mainpage/traders.png" alt="Задачи у торговцев" title="Задачи у торговцев">
                    </a>

                    <p class="size-16">В этом разделе вы можете найти информацию о всех доступных квестах торговцев в Escape from Tarkov. Здесь собраны рекомендации по прохождению квестов, описания квестов, а также важные нюансы, которые являются неочевидными в процессе прохождения квестов Escape from Tarkov.</p>
    
                    <p><a class="btn btn-default main-link" href="/quests-of-traders">Перейти в раздел квестов EFT</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Ключи от дверей</h2>

                    <a href="/keys">
                        <img class="preview-mainpage-desc" src="/img/mainpage/keys.png" alt="Ключи от дверей" title="Ключи от дверей">
                    </a>
    
                    <p class="size-16">В данном разделе - вы сможете найти информацию о любом ключе открывающим двери и помещения в Escape from Tarkov. Вы сможете увидеть где можно найти тот или иной ключ, как выглядят открываемые двери а также увидеть что находится внутри открытых вами помещений.</p>

                    <p><a class="btn btn-default main-link" href="/keys">Перейти в раздел ключей EFT</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Карты локаций</h2>

                    <a href="/maps">
                        <img class="preview-mainpage-desc" src="/img/mainpage/maps.png" alt="Карты локаций" title="Карты локаций">
                    </a>
    
                    <p class="size-16">Здесь вы сможете воспользоваться интерактивными картами локаций Escape from Tarkov - воспользоваться поиском ключей, посмотреть как выглядят карты локаций, сделать пометки по прохождению рейда. Очень полезный инструмент, который пригодится всем игрокам Escape from Tarkov.</p>
    
                    <p><a class="btn btn-default main-link" href="/maps">Перейти к интерактивным картам EFT</a></p>
                </div>

                <div class="col-lg-4">
                    <h2>Справочник лута</h2>

                    <a href="/loot">
                        <img class="preview-mainpage-desc" src="/img/mainpage/mainloot.png" alt="Справочник лута" title="Справочник лута">
                    </a>

                    <p class="size-16">В этом разделе - вы найдете всю информацию по любому луту из Escape from Tarkov. Тут есть все от бесполезного хлама, до раздела со всем доступным оружием в игре и модулями, а также полная информация по любой экипировке доступной в Таркове.</p>

                    <p><a class="btn btn-default main-link" href="/loot">Перейти в справочник лута EFT</a></p>
                </div>

                <div class="col-lg-4">
                    <h2>Справочник умений</h2>

                    <a href="/skills">
                        <img class="preview-mainpage-desc" src="/img/mainpage/skills.png" alt="Справочник умений" title="Справочник умений">
                    </a>

                    <p class="size-16">В этом разделе - вы найдете всю доступную информацию об умениях персонажа, которые доступны к прокачке. Здесь можно узнать какие умения влияют на вашу выживаемость в мире Таркова. Информация и цифры взяты с официальных документов разработчиков.</p>

                    <p><a class="btn btn-default main-link" href="/skills">Перейти в справочник умений EFT</a></p>
                </div>

                <div class="col-lg-4">
                    <h2>Квестовый лут</h2>

                    <a href="/loot/quest-loot">
                        <img class="preview-mainpage-desc" src="/img/mainpage/questloot.png" alt="Квестовый лут" title="Квестовый лут">
                    </a>

                    <p class="size-16">В этом разделе - вы узнаете какой лут обязательно стоит сохранить, т.к. в Таркове есть квесты - необходимо знать какой лут вам пригодится, а какой можно продать - именно тут вы узнаете какие предметы являются квестовыми в Таркове.</p>

                    <p><a class="btn btn-default main-link" href="/loot/quest-loot">Перейти к квестовым предметам EFT</a></p>
                </div>

            </div>
            
            
            <div class="margin-top-20">
                    
                <div class="row margin-top-20">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-adb">
                        <?= $this->render('/other/google-gor.php'); ?>

                        <!-- Виджет Вконтакте -->
                        <div class="vk-widget-styling">
                            <script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>

                            <!-- VK Widget -->
                            <?= $this->render('/other/wk-widget'); ?>
                        </div>
                    </div>

                    <!-- Виджет Discord -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="margin-top-20">
                            <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="207" allowtransparency="true"></iframe>
                        </div>

                        <script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>
                    </div>
                    
                    <!-- Dop. content block -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-adb">
                        <?= $this->render('/other/google-gor.php'); ?>
                    </div>

                </div>
            </div>

            
        </div>
    </div>
</div>