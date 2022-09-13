<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 14.03.2018
 * Time: 13:45
 */

use yii\web\JqueryAsset;
use yii\widgets\LinkPager;
use yii\data\Pagination;

/* @var Pagination $pagination - объекта класса пагинации */

$this->title = 'Escape from Tarkov: Часто задаваемые вопросы';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Наиболее часто задаваемые вопросы по игровому процессу в онлайн-шутере Escape from Tarkov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Escape from Tarkov - часто задаваемые вопросы',
]);

$this->registerJsFile('js/tabs-quests.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/questions.js', ['depends' => [JqueryAsset::class]]);
?>
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>

        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">

            <!-- question-content -->
            <?php if(!empty($questions)) : ?>
                <?php foreach($questions as $k => $item): ?>

                    <?php if(in_array($k,Yii::$app->params['keysBlocks'])): ?>
                        <!-- feed recomendations -->
                        <div class="question-block bg-white" style="height: auto; min-height: 180px; display: block;">
                            <?= $this->render('/other/adsense-questions-feed.php'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="question-block bg-white">
                        <h2 class="question-title"><?=$item['title'] ?></h2>

                        <div class="toggle-block slide">
                            <div class="js-slide-hidden slide" style="display: none;">
                                <?=$item['content'] ?>
                            </div>
                            <a class="btn btn-default main-link float-right mobile-btn-margin opener" href="javascript:void(0)"><span>Читать ответ</span><em>Скрыть ответ</em></a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="col-lg-12 pagination text-center">
                    <?= LinkPager::widget([
                        'pagination' => $pagination,
                        'firstPageLabel' => 'первая',
                        'lastPageLabel' => 'последняя',
                        'prevPageLabel' => '&laquo;'
                    ]);
                    ?>
                </div>
            <?php elseif(empty($questions)): ?>
                    <div class="question-block bg-white">
                        <div class="col-lg-12" style="margin-top: 27px;">
                            <p class="alert alert-danger size-16">Данный раздел находится на стадии заполнения.</p>
                        </div>
                    </div>
            <?php endif; ?>

            <div class="recommended-gm-content">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>

        </div>

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

            <!-- Виджет Вконтакте -->
            <div class="vk-widget-styling">
                <?= $this->render('/other/wk-widget'); ?>
            </div>

            <!-- Виджет дискорда -->
            <div class="margin-top-20"></div>
            <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true"></iframe>

        </div>

    </div>
</div>
