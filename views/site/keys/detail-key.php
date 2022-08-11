<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 06.01.2018
 * Time: 21:41
 */

use app\components\AlertComponent;

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
    'content' => 'https://wiki-tarkov.ru/'.$model['url'],
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $model['description'],
]);
/******** Окончание OpenGraph тегов ************/

$this->registerJsFile('js/keys-scripts.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<style>
    img.image-link {
        color: black!important;
        outline: none;
        box-shadow: 0 0 6px 2px;
    }
</style>

<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>
        
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

                <div class="recommended-gm-content">
                    <?= $this->render('/other/google-recommended.php'); ?>
                </div>

                <!-- Комментарии -->
                <?= $this->render('/other/comments');?>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                <!--Yandex direct -->
                <?= $this->render('/other/yandex-direct.php'); ?>

                <!-- Виджет Вконтакте -->
                <div class="vk-widget-styling">
                    <?= $this->render('/other/wk-widget'); ?>
                </div>

                <!-- Виджет дискорда -->
                <?= $this->render('/other/discord-widget.php'); ?>


                <?= $this->render('/other/yandex-donate.php'); ?>

            </div>
        </div>
    </div>
</div>

