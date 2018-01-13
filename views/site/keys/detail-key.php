<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 06.01.2018
 * Time: 21:41
 */

$this->title = 'Escape from Tarkov: ' .$model['name'];
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
    'content' => $model['name'],
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => 'https://tarkov-wiki.ru/'.$model['url'],
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $model['description'],
]);

/******** Окончание OpenGraph тегов ************/

$this->registerJsFile('js/keys-scripts.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<style>
    img.image-link {
        color: black!important;
        outline: none;
        box-shadow: 0 0 6px 2px;
    }
</style>


<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading"><?=$model['name']?></h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">
        <div class="col-lg-12 keys-content">
            
            <div class="col-lg-12">
                
                    <div class="col-lg-12 item-key detail">
                        <img class="w-100 margin-5 f-left fixible" src="<?=$model['preview']?>">
                        <div class="item-content d-block w-100">
                            <p class="size-16">Ключ используется на локациях: <b><?=$model['mapgroup']?></b></p>
                            <?=$model['content']?>
                        </div>
                    </div>

                <a href="/keys"><button type="button" class="btn btn-primary margin-top-15">Вернуться в справочник ключей</button></a>
            </div>

            <!-- Расстояние - заглушка -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>


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
    </div>
</div>

