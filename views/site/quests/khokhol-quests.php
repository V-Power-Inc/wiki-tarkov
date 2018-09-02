<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.07.2018
 * Time: 15:29
 */

$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Квесты Хохла в Escape from Tarkov. Разбор и прохождение квестов Хохла.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Прохождение и разбор квестов Хохла по онлайн-шутеру Escape from Takov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Квесты Хохла в Escape from Tarkov, квесты хохол Тарков',
]);

use app\components\AlertComponent;
?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Квесты Хохла</h1>
    </div>
</div>

<hr class="grey-line" style="border-top: 0;">

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

        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <ul class="nav nav-list bs-docs-sidenav">
                <?php foreach ($khokhol as $item): ?>
                    <li><a data-toggle="tab" href="#<?=$item['tab_number']?>" class="relative"><i class="fa fa-chevron-right"></i><?=$item['title']?></a></li>
                <?php endforeach; ?>
            </ul>

            <div class="margin-top-20">
                <?php if ($this->beginCache(Yii::$app->params['discordCache'], ['duration' => 604800])) { ?>
                    <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
                    <?php  $this->endCache(); } ?>
            </div>

            <?= $this->render('/other/yandex-donate.php'); ?>

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>
        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">
            <div class="info-quests" id="info-alert-prapor" style="display: none;">
                <p class="alert alert-info sm-vertical-margin-20 size-16">Написать в текст - в данный момент его нет.<br>
                    <!--                    <br><b>Квесты актуальны на патч 0.8.5.1369</b>-->
                </p>
                <!-- Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна. -->


                <!--                <p class="alert alert-danger size-16">В настоящий момент здесь опубликованы не все квесты этого торговца, в ближайшее время появятся недостающие.</p>-->
                <!--                <img class="torgovec-info-quest-image" src="/img/torgovcy/mehanic-quests/leshy-full.jpg" alt="Квесты торговца Лыжника из Escape from Tarkov">-->
            </div>
            <div class="tab-content">
                <?php foreach ($khokhol as $item): ?>
                    <div id="<?=$item['tab_number']?>" class="tab-pane fade">
                        <?php if ($item['preview']):?> <img class="preview-small-image" src="<?= $item['preview'] ?>" alt="<?= $item['title'] ?>"> <?php endif; ?>
                        <?=$item['content']?>
                    </div>
                <?php endforeach; ?>
            </div>

            <br>
            <button class="btn btn-primary"><a href="/quests-of-traders" style="color: white; text-decoration: none;">Вернуться к списку торговцев</a></button>
        </div>

        <div class="recommended-gm-content">
            <?= $this->render('/other/google-recommended.php'); ?>
        </div>

        <!-- Расстояние - заглушка -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>

        <!-- Комментарии -->
        <div id="mc-container" class="kek-recustom"></div>
        <script type="text/javascript">
            cackle_widget = window.cackle_widget || [];
            cackle_widget.push({widget: 'Comment', id: 57165});
            (function() {
                var mc = document.createElement('script');
                mc.type = 'text/javascript';
                mc.async = true;
                mc.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cackle.me/widget.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
            })();
        </script>



    </div>
</div>