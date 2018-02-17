<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 20.01.2018
 * Time: 17:02
 */

$this->registerJsFile('js/news.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Escape from Tarkov: ' .$model['title'];
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
    'content' => 'https://tarkov-wiki.ru/'.$model['url'],
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $model['description'],
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => $model['preview'],
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
        <h1 class="main-site-heading"><?=$model['title']?></h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">


        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <div class="news-shortitem bg-white">
                <span class="news-date d-block"><?=date('d-m-Y',strtotime($model['date_create']))?></span>
                <br>
                <img class="news-titleimage" alt="<?=$model['title']?>" src="<?=$model['preview']?>">
                <div class="text-left"><?=$model['content'] ?></div>
                
                <br>
                
                <p class="text-right"><a class="btn btn-default main-link" href="/news">Вернуться к списку новостей</a></p>
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
            <html>
            <body>
            <div id="twitch-embed" class="margin-top-15"></div>
            <script src="https://embed.twitch.tv/embed/v1.js"></script>
            <script type="text/javascript">
                new Twitch.Embed("twitch-embed", {
                    width: 261,
                    height: 380,
                    layout: "video",
                    autoplay: false,
                    channel: "enslaver_V"
                });
                var player = new Twitch.Player("<enslaver_V>", options);
                player.setVolume(0);
            </script>
            </body>
            </html>

            <!-- Виджет дискорда -->
            <div class="margin-top-20"></div>
            <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
        </div>
            
        
    </div>
</div>
