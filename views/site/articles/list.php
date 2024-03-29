<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 29.01.2018
 * Time: 14:09
 */

use yii\widgets\LinkPager;
use app\models\Articles;
use yii\data\Pagination;

/**
 * @var Articles[] $news - массив AR объектов полезных материалов
 * @var Pagination $pagination - объект пагинации
 */

$this->title = 'Полезные статьи по Escape from Tarkov';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Полезные статьи по онлайн шутеру Escape from Tarkov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Полезные статьи Escape from Tarkov, Полезные статьи в Таркове',
]);
?>
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>

        <!-- Основной блок контента -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">

            <p class="alert alert-info sm-vertical-margin-20 size-16">
                Полезные материалы по онлайн-шутеру Escape from Tarkov. В этом разделе вы сможете прочить про некоторые внутриигровые нюансы, о которых ранее вы могли не знать. Также в этом разеделе будут описаны всевозможные вариации горячий клавиш и прочее. Актуальность информации также гарантируется.
            </p>

            <!--- Новостной блок -->
            <?php foreach($news as $k => $item): ?>

                <?php if(in_array($k,Yii::$app->params['keysBlocks'])): ?>
                    <!-- feed recomendations -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="news-shortitem static-height-afm">
                            <?= $this->render('/other/adsense-feed.php'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="news-shortitem">
                        <p class="news-short-title"><a class="news-link" href="/articles/<?=$item[Articles::ATTR_URL]?>"><?=$item[Articles::ATTR_TITLE]?></a></p>
                        <span class="news-date"><?=date('d-m-Y',strtotime($item[Articles::ATTR_DATE_CREATE]))?></span>
                        <a class="news-link" href="/articles/<?=$item[Articles::ATTR_URL]?>"><img class="news-titleimage" alt="<?=$item[Articles::ATTR_TITLE]?>" src="<?=$item[Articles::ATTR_PREVIEW]?>"></a>
                        <div class="text-left news-short-text"><?= $item[Articles::ATTR_SHORTDESC] ?></div>
                        <p class="text-right"><a class="btn btn-default main-link" href="/articles/<?=$item[Articles::ATTR_URL]?>">Читать детально</a></p>
                    </div>


                </div>
            <?php endforeach; ?>
            <!-- Окончание новостного блока -->

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>
            
            <!-- Пагинатор -->
            <div class="row">
                <div class="col-lg-12 pagination text-center">
                    <?= LinkPager::widget([
                        'pagination' => $pagination,
                        'firstPageLabel' => 'первая',
                        'lastPageLabel' => 'последняя',
                        'prevPageLabel' => '&laquo;'
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>
        </div>
        
    </div>
</div>