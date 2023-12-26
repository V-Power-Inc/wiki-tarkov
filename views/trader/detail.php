<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 23.02.2018
 * Time: 17:49
 */

use yii\web\JqueryAsset;
use app\models\Traders;
use app\models\Barters;

/* @var Traders $trader - AR объект торговца */

$this->registerJsFile('js/news.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/questions.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/barter-tabs.js', ['depends' => [JqueryAsset::class]]);
$this->title = 'Торговцы Escape from Tarkov: ' . $trader->title;
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
    'content' => $_ENV['DOMAIN_PROTOCOL'].$_ENV['DOMAIN'].'/traders/'.$trader->url,
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

    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-bottom: 2px solid black;
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

                <p class="mobile-text-center">
                    <?php if ($trader->urltoquets !== '' && $trader->urltoquets !== null): ?>
                        <a class="btn btn-default main-link float-right mobile-btn-margin" href="<?= $trader->urltoquets ?>"><?= $trader->button_quests ?></a>
                    <?php endif; ?>
                    <a class="btn btn-default main-link float-left mobile-btn-margin" href="/quests-of-traders">Вернуться к списку торговцев</a>
                </p>
                
                <img class="news-titleimage w-100-auto block-disp" alt="<?=$trader->title?>" src="<?=$trader->preview?>">

                <div class="text-left">
                    <?=$trader->fullcontent ?>
                </div>

                <div class="barters-block">
                    <?php if(!empty($barters)): ?>

                        <!-- Табы -->
                        <ul class="nav nav-tabs barters">
                            <?php foreach($barters as $key => $value): ?>
                                <?php if($key == 0): ?>
                                    <li><a class="first-lvl <?=$trader->url.$value[Barters::ATTR_ID]?>" data-toggle="tab" href="#<?=$trader->url.$value[Barters::ATTR_ID]?>"><?=$value[Barters::ATTR_SITE_TITLE]?></a></li>
                                <?php else: ?>
                                    <li><a data-toggle="tab" class="<?=$trader->url.$value[Barters::ATTR_ID]?>" href="#<?=$trader->url.$value[Barters::ATTR_ID]?>"><?=$value[Barters::ATTR_SITE_TITLE]?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Контент табов -->
                        <div class="tab-content">
                            <?php foreach($barters as $key => $value): ?>
                                <?php if($key == 0): ?>
                                    <div id="<?=$trader->url.$value[Barters::ATTR_ID]?>" class="tab-pane fade in active">
                                        <h3><?=$value[Barters::ATTR_TITLE]?></h3>
                                        <p><?=$value[Barters::ATTR_CONTENT]?></p>
                                    </div>
                                <?php else: ?>
                                    <div id="<?=$trader->url.$value[Barters::ATTR_ID]?>" class="tab-pane fade in">
                                        <h3><?=$value[Barters::ATTR_TITLE]?></h3>
                                        <p><?=$value[Barters::ATTR_CONTENT]?></p>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <br>

                <p class="mobile-text-center">
                    <?php if ($trader->urltoquets !== '' && $trader->urltoquets !== null): ?>
                        <a class="btn btn-default main-link float-right mobile-btn-margin" href="<?= $trader->urltoquets ?>"><?= $trader->button_quests ?></a>
                    <?php endif; ?>
                        <a class="btn btn-default main-link float-left mobile-btn-margin" href="/quests-of-traders">Вернуться к списку торговцев</a>
                </p>

            </div>
            
            <div class="recommended-gm-content">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>

        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <div class="margin-top-20"></div>
            
            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>

    </div>
</div>