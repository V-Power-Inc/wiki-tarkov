<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 30.09.2018
 * Time: 0:17
 */

$this->registerJsFile('js/news.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/questions.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Предпросмотр: '.$barter->title;

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
        <h1 class="main-site-heading">Некий торговец</h1>
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

                <div class="text-left">
                    <p>Тут обычно контент с картинками, не обращаем внимания.</p>
                </div>

                <div class="barters-block">
                        <!-- Табы -->
                        <ul class="nav nav-tabs barters">
                            <li><a data-toggle="tab" class="<?=$id?>" href="#<?=$id?>"><?=$barter->site_title ?></a></li>
                        </ul>

                        <!-- Контент табов -->
                        <div class="tab-content">
                            <div id="<?=$id?>" class="tab-pane fade in">
                                <h3><?=$barter['title']?></h3>
                                <p><?=$barter['content']?></p>
                            </div>
                        </div>

                </div>

            </div>

        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

            <!-- Виджет дискорда -->
            <div class="margin-top-20"></div>
            <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
                <?php  $this->endCache(); } ?>

        </div>


    </div>
</div>