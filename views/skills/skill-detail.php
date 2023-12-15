<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 25.01.2018
 * Time: 19:19
 */

use yii\web\JqueryAsset;
use app\models\Items;

/* @var Items $item - объект справочника лута */

/** Преобразуем title в нижний регистр **/
$lowertitle = mb_strtolower($item->title);

$this->title = "Escape from Tarkov: Умение $lowertitle";

$this->registerMetaTag([
    'name' => 'description',
    'content' => $item->description,
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $item->keywords,
]);

$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/news.js', ['depends' => [JqueryAsset::class]]);
?>
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">

            <div class="row">
                <!-- Итем из таблицы предметов -->
                <div class="col-lg-12">
                    <div class="item-loot">

                        <a class="loot-link"><img class="loot-image" alt="<?= $item->title ?>" src="<?= $item->preview ?>"></a>
                        <p class="loot-description">
                            <?= $item->content ?>
                        </p>
                        <p class="text-right"><a class="btn btn-default main-link" onclick="javascript:history.back(); return false;">Вернуться на предыдущую страницу</a></p>
                    </div>
                </div>
                <!-- Окончания итем из цикла -->
            </div>

            <div class="recommended-gm-content">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Расстояние - заглушка -->
            <div class="height-25"></div>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>

        </div>


        <!-- Меню правой части страницы -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>

    </div>
</div>