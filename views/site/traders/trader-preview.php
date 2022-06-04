<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 13.07.2018
 * Time: 23:58
 */
$this->registerJsFile('js/news.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/questions.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Предпросмотр: '.$trader->title;

use app\components\AlertComponent;
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
            <!-- ads block -->
        </div>

        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <div class="news-shortitem bg-white">

                <p class="mobile-text-center">
                    <?php if ($trader->urltoquets !== '' && $trader->urltoquets !== null): ?>
                        <a class="btn btn-default main-link float-right mobile-btn-margin" href="<?= $trader->urltoquets ?>"><?= $trader->button_quests ?></a>
                    <?php endif; ?>
                    <a class="btn btn-default main-link float-left mobile-btn-margin" href="/quests-of-traders">Вернуться к списку торговцев</a>
                </p>

                <img class="news-titleimage block-disp w-100-auto" alt="<?=$trader->title?>" src="<?=$trader->preview?>">
                <div class="text-left"><?=$trader->fullcontent ?></div>

                <br>

                <p class="mobile-text-center">
                    <?php if ($trader->urltoquets !== '' && $trader->urltoquets !== null): ?>
                        <a class="btn btn-default main-link float-right mobile-btn-margin" href="<?= $trader->urltoquets ?>"><?= $trader->button_quests ?></a>
                    <?php endif; ?>
                    <a class="btn btn-default main-link float-left mobile-btn-margin" href="/quests-of-traders">Вернуться к списку торговцев</a>
                </p>


            </div>

            <!-- ads block -->

        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

            <!-- Виджет дискорда -->
            <div class="margin-top-20"></div>
            <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                <?= $this->render('/other/discord-widget.php'); ?>
            <?php  $this->endCache(); } ?>

        </div>


    </div>
</div>
