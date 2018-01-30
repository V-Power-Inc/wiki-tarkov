<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 29.01.2018
 * Time: 14:09
 */

use yii\widgets\LinkPager;

$this->title = 'Полезные статьи по Escape from Tarkov.';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Полезные статьи по онлайн шутеру Escape from Tarkov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Полезные статьи Escape from Tarkov, Полезные статьи в Таркове',
]);

?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Полезная информация по Escape from Tarkov</h1>
    </div>
</div>

<hr class="grey-line">

<div class="container">
    <div class="row">

        <!-- Основной блок контента -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">

            <p class="alert alert-info sm-vertical-margin-20 size-16">
                Полезные материалы по онлайн-шутеру Escape from Tarkov. В этом разделе вы сможете прочить про некоторые внутриигровые нюансы, о которых ранее вы могли не знать. Также в этом разеделе будут описаны всевозможные вариации горячий клавиш и прочее. Актуальность информации также гарантируется.
            </p>

            <!--- Новостной блок -->
            <?php foreach($news as $item): ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="news-shortitem">
                        <p class="news-short-title"><a class="news-link" href="/articles/<?=$item['url']?>"><?=$item['title']?></a></p>
                        <span class="news-date"><?=date('d-m-Y',strtotime($item['date_create']))?></span>
                        <a class="news-link" href="/articles/<?=$item['url']?>"><img class="news-titleimage" alt="<?=$item['title']?>" src="<?=$item['preview']?>"></a>
                        <div class="text-left news-short-text"><?= $item['shortdesc'] ?></div>
                        <p class="text-right"><a class="btn btn-default main-link" href="/articles/<?=$item['url']?>">Читать детально</a></p>
                    </div>


                </div>
            <?php endforeach; ?>
            <!-- Окончание новостного блока -->

            <!-- Пагинатор -->
            <div class="row">
                <div class="col-lg-12 pagination text-center">
                    <?= LinkPager::widget([
                        'pagination' => $pagination,
                        'firstPageLabel' => 'первая',
                        'lastPageLabel' => 'последняя',
                        'prevPageLabel' => '&laquo;',
                        'prevPageLabel' => '&laquo;',
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
        </div>
    </div>
</div>