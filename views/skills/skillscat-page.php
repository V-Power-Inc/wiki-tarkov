<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.02.2018
 * Time: 13:12
 */

use app\components\LeftmenuWidget;
use yii\widgets\LinkPager;
use Yii;

$this->title = "Escape from Tarkov: " . $cat['title'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => $cat['description'],
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $cat['keywords'],
]);

/******** OpenGraph теги ************/

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $cat['title'],
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => 'https://tarkov-wiki.ru'. Yii::$app->request->url,
]);

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $cat['description'],
]);


$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/conv.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$keysBlocks = [8];

use app\components\AlertComponent;
?>
<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading"><?= $cat->title ?></h1>
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

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">

            <!-- Описание категории -->
            <div class="alert alert-info size-16"><?= $cat->content ?></div>

            <div class="col-lg-12">
                <p class="text-right"><a class="btn btn-default main-link" href="/skills">Вернуться в справочник умений</a></p>
            </div>
            
            <?php if(empty($items) || is_null($items)) : ?>
                <!-- Нет лута -->
                <div class="col-lg-12">
                    <p class="alert alert-danger size-16">В данный момент в разделе нет доступных умений.</p>
                </div>
                <!-- Нет лута -->
            <?php else : ?>

                <!-- core from 07-11-2018 -->


                <!-- Цикл предметов категории -->
                <?php foreach ($items as $item => $v) : ?>

                    <?php if(in_array($item,$keysBlocks)): ?>
                        <div class="col-lg-12 fixible-block">
                            <div class="item-loot h-130">
                                <?= $this->render('/other/adsense-feed.php'); ?>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php if($v['enabled'] == 1) : ?>
                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a href="/skills/<?= $cat->url ?>/<?= $v['url'] ?>.html"><?= $v['title'] ?></a></h2>
                                <a class="loot-link" href="/skills/<?= $cat->url ?>/<?= $v['url'] ?>.html"><img class="loot-image" alt="<?= $v['title'] ?>" src="<?= $v['preview'] ?>"></a>
                                <p class="loot-description"><?= $v['short_desc'] ?></p>
                            </div>
                        </div>
                    <?php elseif($v['enabled'] == 0) : ?>
                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a><?= $v['title'] ?></a></h2>
                                <a class="loot-link"><img class="loot-image" alt="<?= $v['title'] ?>" src="<?= $v['preview'] ?>"></a>
                                <p class="loot-description"><?= $v['short_desc'] ?></p>
                                <p class="alert alert-danger size-16 unactive-skill">В настоящий момент это умение не реализовано в игре.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <!-- Окончание цикла предметов -->
            <?php endif; ?>

            <div class="col-lg-12">
                <p class="text-right"><a class="btn btn-default main-link" href="/skills">Вернуться в справочник умений</a></p>
            </div>

            <div class="recommended-gm-content">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Расстояние - заглушка -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>



        </div>


        <!-- Меню правой части страницы -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

            <!-- Виджет Вконтакте -->
            <div class="vk-widget-styling">
                <?= $this->render('/other/wk-widget'); ?>
            </div>

            <!-- Виджет Discord -->
            <div class="margin-top-20">
                <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                    <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
                <?php  $this->endCache(); } ?>
            </div>

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>


    </div>
</div>
