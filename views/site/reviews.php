<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.01.2019
 * Time: 20:07
 */

/*** Вьюха рендерит отзывы пользователей, об онлайн-торговце ***/

use app\components\AlertComponent;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->title = 'Отзывы о сделках в Escape from Tarkov';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Отзывы о сделках в Escape from Tarkov - проведенных через онлайн-торговца',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Отзывы о сделках в Escape from Tarkov',
]);

?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Отзывы о сделках в Escape from Tarkov</h1>
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

        <!-- Основной блок контента -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">

            <?php  if(Yii::$app->getSession()->getFlash('message')):?>
                <?=Yii::$app->getSession()->getFlash('message')?>
            <?php endif;?>

            <p class="alert alert-info sm-vertical-margin-20 size-16">
               В Escape from Tarkov тема лута стала очень популярна, порой очень сложно достать ту или иную вещь. В этом случае вам может помочь наш онлайн-торговец. На этой странице вы можете оставить отзыв о качестве обслуживания нашим онлайн-торговцем. Мы будем прислушиваться к вашим отзывам и меняться к лучшему!
            </p>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <?php $form = ActiveForm::begin(['action' => 'savereview','options' => ['class' => 'reviews-form']]); ?>

                <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'reCaptcha')->widget(
                    \himiklab\yii2\recaptcha\ReCaptcha::className(),
                    ['siteKey' => '6LeP7D0UAAAAALclAz0rCJhO-r00oJ2zkkyW-_sW']
                ) ?>

                <button type="submit" class="btn btn-primary">Отправить отзыв</button>

                <?php ActiveForm::end(); ?>

            </div>

            <?php if(empty($reviews)): ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="alert alert-danger size-16">К сожалению в данный момент отзывов еще нет. Вы также можете отправить первый отзыв!</p>
            </div>

            <?php else: ?>

                <!--- Новостной блок -->
                <?php foreach($reviews as $item): ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="news-shortitem">
                            <p class="news-short-title"><?=$item['login']?></p>
                            <span class="news-date">Отзыв был добавлен: <?=date('d-m-Y H:i:s',strtotime($item['date_create']))?></span>
                            <div class="text-left news-short-text margin-top-10"><?= $item['comment'] ?></div>

                            <?php if($item['admin_review'] !== ''): ?>
                                <p class="alert alert-success margin-top-20 size-16"><b>Ответ администрации:</b> <?=$item['admin_review']?></p>
                            <?php endif; ?>

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

            <?php endif; ?>

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
            <iframe src="https://discordapp.com/widget?id=405924890328432652&theme.." width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>

            <?= $this->render('/other/yandex-donate.php'); ?>

        </div>

    </div>
</div>
