<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.02.2018
 * Time: 13:12
 */


?>

<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 28.01.2018
 * Time: 0:17
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
        
        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">

            <!-- Описание категории -->
            <div class="alert alert-info size-16"><?= $cat->content ?></div>

            <div class="col-lg-12">
                <p class="text-right"><a class="btn btn-default main-link" href="/skills">Вернуться в справочник умений</a></p>
            </div>
            
            <?php if(empty($items)) : ?>
                <!-- Нет лута -->
                <div class="col-lg-12">
                    <p class="alert alert-danger size-16">В данный момент в разделе нет доступных умений.</p>
                </div>
                <!-- Нет лута -->
            <?php else : ?>
                <!-- Цикл предметов категории -->
                <?php foreach ($items as $item) : ?>
                    <?php if($item['enabled'] == 1) : ?>
                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a href="/skills/<?= $cat->url ?>/<?= $item['url'] ?>.html"><?= $item['title'] ?></a></h2>
                                <a class="loot-link" href="/skills/<?= $cat->url ?>/<?= $item['url'] ?>.html"><img class="loot-image" alt="<?= $item['title'] ?>" src="<?= $item['preview'] ?>"></a>
                                <p class="loot-description"><?= $item['short_desc'] ?></p>
                            </div>
                        </div>
                    <?php elseif($item['enabled'] == 0) : ?>
                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a><?= $item['title'] ?></a></h2>
                                <a class="loot-link"><img class="loot-image" alt="<?= $item['title'] ?>" src="<?= $item['preview'] ?>"></a>
                                <p class="loot-description"><?= $item['short_desc'] ?></p>
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
            <?php if(empty($_GET)) : ?>
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
            <?php endif; ?>


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
