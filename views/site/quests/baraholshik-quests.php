<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 12.05.2018
 * Time: 13:51
 */

$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Квесты Барахольщика в Escape from Tarkov. Разбор и прохождение квестов Барахольщика.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Прохождение и разбор квестов Барахольщика по онлайн-шутеру Escape from Takov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Квесты Барахольщика в Escape from Tarkov, квесты Барахольщика Тарков',
]);

use app\components\AlertComponent;
?>


<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Квесты Барахольщика</h1>
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
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <ul class="nav nav-list bs-docs-sidenav">
                <?php foreach ($baraholshik as $item): ?>
                    <li><a data-toggle="tab" href="#<?=$item['tab_number']?>" class="relative"><i class="fa fa-chevron-right"></i><?=$item['title']?></a></li>
                <?php endforeach; ?>
            </ul>

            <div class="margin-top-20">
                <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
            </div>

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">
            <div class="info-quests" id="info-alert-prapor" style="display: none;">
                <p class="alert alert-info sm-vertical-margin-20 size-16">Квесты Барахольщика вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.</p>
                <img class="torgovec-info-quest-image" src="/img/torgovcy/baraholshik-quests/baraholshik-full.jpg" alt="Квесты торговца Барахольщика из Escape from Tarkov">
            </div>
            <div class="tab-content">
                <?php foreach ($baraholshik as $item): ?>
                    <div id="<?=$item['tab_number']?>" class="tab-pane fade">
                        <?php if ($item['preview']):?> <img class="preview-small-image" src="<?= $item['preview'] ?>" alt="<?= $item['title'] ?>"> <?php endif; ?>
                        <?=$item['content']?>
                    </div>
                <?php endforeach; ?>
            </div>

            <br>
            <button class="btn btn-primary"><a href="/quests-of-traders" style="color: white; text-decoration: none;">Вернуться к списку торговцев</a></button>
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