<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 29.01.2018
 * Time: 14:19
 */

use app\models\Articles;
use yii\web\JqueryAsset;

$this->registerJsFile('js/news.js', ['depends' => [JqueryAsset::class]]);
$this->title = 'Escape from Tarkov: ' .$model['title'];
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model[Articles::ATTR_DESCRIPTION],
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model[Articles::ATTR_KEYWORDS],
]);

/******** OpenGraph теги ************/

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $model[Articles::ATTR_TITLE],
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => $_ENV['DOMAIN_PROTOCOL'].$_ENV['DOMAIN'].'/'.$model['url'],
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $model[Articles::ATTR_DESCRIPTION],
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => $model[Articles::ATTR_PREVIEW],
]);
/******** Окончание OpenGraph тегов ************/
?>
<style>
    img.image-link {
        border: 1px solid white;
        box-shadow: 1px 1px 6px 2px;
    }
</style>

<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <div class="news-shortitem bg-white">
                <span class="news-date d-block"><?=date('d-m-Y',strtotime($model[Articles::ATTR_DATE_CREATE]))?></span>
                <br>
                <img class="news-titleimage" alt="<?=$model[Articles::ATTR_TITLE]?>" src="<?=$model[Articles::ATTR_PREVIEW]?>">
                <div class="text-left"><?=$model[Articles::ATTR_CONTENT] ?></div>

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
        </div>

    </div>
</div>