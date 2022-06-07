<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 23.02.2018
 * Time: 17:49
 */

$this->registerJsFile('js/news.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/questions.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/barter-tabs.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Торговцы Escape from Tarkov: ' .$trader->title;
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

use app\components\AlertComponent;
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

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading"><?=$trader->title?></h1>
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
                    <?php if(empty($barters)): ?>
                      <!--  <p class="alert alert-danger size-16">
                            Для данного торговца информация о бартерах и продаваемых товарах не найдена.
                        </p> -->
                    <?php else: ?>

                        <!-- Табы -->
                        <ul class="nav nav-tabs barters">
                            <?php foreach($barters as $key => $value): ?>
                                <?php if($key == 0): ?>
                                    <li><a class="first-lvl <?=$trader->url.$value['id']?>" data-toggle="tab" href="#<?=$trader->url.$value['id']?>"><?=$value['site_title']?></a></li>
                                <?php else: ?>
                                    <li><a data-toggle="tab" class="<?=$trader->url.$value['id']?>" href="#<?=$trader->url.$value['id']?>"><?=$value['site_title']?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Контент табов -->
                        <div class="tab-content">
                            <?php foreach($barters as $key => $value): ?>
                                <?php if($key == 0): ?>
                                    <div id="<?=$trader->url.$value['id']?>" class="tab-pane fade in active">
                                        <h3><?=$value['title']?></h3>
                                        <p><?=$value['content']?></p>
                                    </div>
                                <?php else: ?>
                                    <div id="<?=$trader->url.$value['id']?>" class="tab-pane fade in">
                                        <h3><?=$value['title']?></h3>
                                        <p><?=$value['content']?></p>
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

            <!-- Виджет Вконтакте -->
            <div class="vk-widget-styling">
                <?= $this->render('/other/wk-widget'); ?>
            </div>

            <!-- Виджет дискорда -->
            <?= $this->render('/other/discord-widget.php'); ?>

            <?= $this->render('/other/yandex-donate.php'); ?>
            
            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>


    </div>
</div>
