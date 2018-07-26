<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 14.03.2018
 * Time: 13:45
 */

$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Escape from Tarkov: Часто задаваемые вопросы';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Наиболее часто задаваемые вопросы по игровому процессу в онлайн-шутере Escape from Tarkov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Escape from Tarkov - часто задаваемые вопросы',
]);

$this->registerJsFile('js/questions.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
use yii\widgets\LinkPager;
use app\components\AlertComponent;
?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Часто задаваемые вопросы</h1>
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

        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">

            <!-- Стиль текста для вопросов и ответов -->
            <!-- question-content -->
    <?php if(!empty($questions)) : ?>
        <?php foreach($questions as $item): ?>
            <div class="question-block bg-white">
                <h2 class="question-title"><?=$item['title'] ?></h2>
                
                <div class="toggle-block slide">
                    <div class="js-slide-hidden slide" style="display: none;">
                        <?=$item['content'] ?>
                    </div>
                    <a class="btn btn-default main-link float-right mobile-btn-margin opener" href="javascript:void(0)" display="block"><span>Читать ответ</span><em>Скрыть ответ</em></a>
                </div>
            </div>
        <?php endforeach; ?>

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
    <?php elseif(empty($questions)): ?>
            <div class="question-block bg-white">
                <div class="col-lg-12" style="margin-top: 27px;">
                    <p class="alert alert-danger size-16">Данный раздел находится на стадии заполнения.</p>
                </div>
            </div>
    <?php endif; ?>

            <div class="row">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>
            
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

        <!-- Боковая правая колонка -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <!-- Виджет дискорда -->
            <div class="margin-top-20"></div>
            <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>

            <?= $this->render('/other/yandex-donate.php'); ?>

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>

            <!-- off ads -->
            <?= $this->render('/other/disable-adblock.php'); ?>

        </div>


    </div>
</div>
