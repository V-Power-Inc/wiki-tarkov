<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 17.10.2018
 * Time: 12:24
 */

use app\common\models\forms\ClansForm;
use yii\widgets\ActiveForm;

$this->title = "Escape from Tarkov: Зарегистрировать новый клан";

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Escape from Tarkov: Зарегистрировать новый клан',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Escape from Tarkov: Зарегистрировать новый клан',
]);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clans-content special-border">

            <?php  if(Yii::$app->getSession()->getFlash('message')):?>
                <?=Yii::$app->getSession()->getFlash('message')?>
            <?php endif;?>
            
            <?php $form = ActiveForm::begin(['action' => '/clan/save', 'options' => ['method' => 'post'], 'id' => 'reg-new-clan']); ?>

            <p class="size-16 alert alert-info margin-top-20">Для отправки заявки на регистрацию вашего клана, отправьте заявку - заполнив следующие поля.
            <br>
            <br>
                <b>Важно!!!</b> Размер логотипа клана должен быть <b>100x100</b> пикселей, а также быть либо формата <b>jpg или png</b> - другие форматы не принимаются.
                <br>
                <br>
                <b>Заполняйте информацию о своем клане достоверно, любая неполноценная информация и кланы с отсутствующим сообществом, либо неполноценно заполненной информацией не будут допущены к публикации.</b>
            </p>
            
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <?= $form->field($model, ClansForm::ATTR_TITLE)->textInput(['placeholder' => 'Введите название вашего клана']) ?>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <?= $form->field($model, ClansForm::ATTR_DESCRIPTION)->textInput(['placeholder' => 'Введите краткое описание вашего клана']) ?>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <?= $form->field($model, ClansForm::ATTR_LINK)->textInput(['placeholder' => 'https://someclan.ru']) ?>
                </div>
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $form->field($model, ClansForm::RECAPTCHA)->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha::class,
                        ['siteKey' => Yii::$app->params['recapchaSiteKey']]
                    ) ?>

                    <?= $form->field($model, ClansForm::ATTR_DATE_UPDATE)->hiddenInput(['value' => date("Y-m-d H:i:s",time())])->label('') ?>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" id="upl-clan-logo" type="button">Загрузить логотип</button>
                    <button type="submit" class="btn btn-success mbl-margin-btn">Зарегистрировать клан</button>
                    <a class="btn btn-info sc-margin-sc-btn" href="/clans">Вернуться к списку кланов</a>
                    <?= $form->field($model, ClansForm::FILE)->fileInput(['class' => 'vs-none'])->label('') ?>
                </div>

            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
</div>