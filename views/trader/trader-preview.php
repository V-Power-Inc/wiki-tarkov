<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 13.07.2018
 * Time: 23:58
 */

use yii\web\JqueryAsset;
use app\models\Traders;

/* @var Traders $trader - AR объект торговца */

$this->registerJsFile('js/news.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/questions.js', ['depends' => [JqueryAsset::class]]);

$this->title = 'Предпросмотр: '.$trader->title;
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
