<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 29.01.2018
 * Time: 14:19
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
                <img class="news-titleimage" src="<?=$model['preview']?>">
                <div class="text-left"><?=$model['content'] ?></div>

                <br>

                <p class="text-right"><a class="btn btn-default main-link" href="/articles">Вернуться к списку статей</a></p>
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
            <!-- Виджет Discord -->
            <div class="    ">
                <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
            </div>
        </div>


    </div>
</div>
