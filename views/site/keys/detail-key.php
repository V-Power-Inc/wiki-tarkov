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

use app\components\AlertComponent;
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

<?php if((AlertComponent::alert()->enabled !== 0)) : ?>
    <!-- Информационная строка -->
    <div class="row">
        <div class="container">
            <div class="col-lg-12 <?= AlertComponent::alert()->bgstyle ?>">
                <marquee style="font-size: 16px; color: white; font-weight: bold; margin-top: 4px;"><?= AlertComponent::alert()->content ?></marquee>
            </div>
        </div>
    </div>
    <hr class="grey-line">
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 keys-content">
            
            <div class="col-lg-12">
                
                    <div class="col-lg-12 item-key detail">
                        <img class="w-100 margin-5 f-left fixible" alt="<?=$model['name']?>" src="<?=$model['preview']?>">
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

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <!-- Виджет дискорда -->

                <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>

                <!--Yandex direct -->
                <?= $this->render('/other/yandex-direct.php'); ?>

            </div>
        </div>
    </div>
</div>

