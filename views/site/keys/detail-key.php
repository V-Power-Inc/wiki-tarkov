<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 06.01.2018
 * Time: 21:41
 */

use app\models\Doorkeys;
use yii\web\JqueryAsset;

$this->title = 'Escape from Tarkov: ' .$model[Doorkeys::ATTR_NAME];
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model[Doorkeys::ATTR_DESCRIPTION],
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model[Doorkeys::ATTR_KEYWORDS],
]);

/******** OpenGraph теги ************/

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $model[Doorkeys::ATTR_NAME],
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => $_ENV['DOMAIN_PROTOCOL'].$_ENV['DOMAIN'].'/'.$model[Doorkeys::ATTR_URL],
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $model['description'],
]);
/******** Окончание OpenGraph тегов ************/

$this->registerJsFile('js/keys-scripts.js', ['depends' => [JqueryAsset::class]]);
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
                        <img class="w-100 margin-5 f-left fixible" alt="<?=$model[Doorkeys::ATTR_NAME]?>" src="<?=$model[Doorkeys::ATTR_PREVIEW]?>">
                        <div class="item-content d-block w-100">
                            <p class="size-16">Ключ используется на локациях: <b><?= $model[Doorkeys::ATTR_MAPGROUP] ?></b></p>
                            <?= $model[Doorkeys::ATTR_CONTENT] ?>
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
            </div>
        </div>
    </div>
</div>