<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.11.2023
 * Time: 18:36
 *
 * Вьюха страницы с формой обратной связи
 */

use app\controllers\FeedbackController;
use app\common\models\forms\FeedbackForm;

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = "Форма обратной связи";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Форма обратной связи',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Форма обратной связи',
]);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clans-content special-border">

            <!-- Flash Messages -->
            <?php  if(Yii::$app->getSession()->getFlash('message')):?>
                <?=Yii::$app->getSession()->getFlash('message')?>
            <?php endif;?>

            <!-- Desc -->
            <p class="size-16 alert alert-info margin-top-20">Эта форма предназначена для отправки обратной связи разработчикам данного сайта. Если вы заметили на сайте ошибки или у вас есть пожелания по функционалу, заполните сообщение и отправьте форму. <br><br> Если вам необходимо продолжить диалог, можете в теле сообщения указать свой email адрес или написать на почту: <b><a href="mailto:tarkov-wiki@ya.ru">tarkov-wiki@ya.ru</a></b></p>

            <!-- Form Start -->
            <?php $form = ActiveForm::begin(['action' => Url::to(FeedbackController::getUrlRoute(FeedbackController::ACTION_INDEX)), 'options' => ['method' => 'post'], 'id' => 'feedback_form']); ?>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $form->field($model, FeedbackForm::ATTR_CONTENT)->textArea(['placeholder' => 'Введите сообщение для отправки', 'rows' => '3']) ?>
            </div>

            <!-- Recapcha -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $form->field($model, FeedbackForm::RECAPTCHA)->widget(
                    \himiklab\yii2\recaptcha\ReCaptcha::class,
                    ['siteKey' => Yii::$app->params['recapchaSiteKey']]
                ) ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                <!-- Submit form button -->
                <?= Html::submitButton('Отправить форму', [
                    'class' => 'btn btn-success mbl-margin-btn'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <!-- Relation -->
            <div class="recommended-gm-content margin-top-30">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>
        </div>

    </div>
</div>