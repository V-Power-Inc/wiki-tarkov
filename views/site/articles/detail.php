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

use app\components\AlertComponent;
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

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <div class="news-shortitem bg-white">
                <span class="news-date d-block"><?=date('d-m-Y',strtotime($model['date_create']))?></span>
                <br>
                <img class="news-titleimage" alt="<?=$model['title']?>" src="<?=$model['preview']?>">
                <div class="text-left"><?=$model['content'] ?></div>

                <br>

                <p class="text-right"><a class="btn btn-default main-link" href="/articles">Вернуться к списку статей</a></p>
            </div>

            <div class="recommended-gm-content">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>


        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

            <!-- Виджет Вконтакте -->
            <div class="vk-widget-styling">
                <?= $this->render('/other/wk-widget'); ?>
            </div>

            <!-- Виджет дискорда -->
            <div class="margin-top-20"></div>
                <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>

            <?= $this->render('/other/yandex-donate.php'); ?>
        
        </div>


    </div>
</div>
