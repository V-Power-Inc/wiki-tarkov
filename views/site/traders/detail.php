<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 23.02.2018
 * Time: 17:49
 */

$this->registerJsFile('js/news.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Escape from Tarkov: ' .$trader->title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $trader->description,
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $trader->keywords,
]);

/******** OpenGraph теги ************/

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $trader->title,
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => 'https://tarkov-wiki.ru/traders/'.$trader->url,
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $trader->description,
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => $trader->preview,
]);

/******** Окончание OpenGraph тегов ************/

?>

<style>
    img.image-link {
        border: 1px solid white;
        box-shadow: 1px 1px 6px 2px;
    }
</style>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading"><?=$trader->title?></h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">



        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <div class="news-shortitem bg-white">
                <img class="news-titleimage w-100-auto" alt="<?=$trader->title?>" src="<?=$trader->preview?>">
                <div class="text-left"><?=$trader->fullcontent ?></div>

                <br>

                <p class="mobile-text-center">
                    <?php if ($trader->urltoquets !== '' && $trader->urltoquets !== null): ?>
                        <a class="btn btn-default main-link float-right mobile-btn-margin" href="<?= $trader->urltoquets ?>"><?= $trader->button_quests ?></a>
                    <?php endif; ?>
                        <a class="btn btn-default main-link float-left mobile-btn-margin" href="/quests-of-traders">Вернуться к списку торговцев</a>
                </p>
            
            
            </div>

            <!-- Комментарии -->
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


        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <!-- Виджет Twitch -->
            <div class="margin-top-15">
                <iframe src="https://player.twitch.tv/?channel=enslaver_v&autoplay=false" frameborder="0" allowfullscreen="true" scrolling="no" height="378" width="100%"></iframe>
            </div>

            <!-- Виджет дискорда -->
            <div class="margin-top-20"></div>
            <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
        </div>


    </div>
</div>
