<?php

use app\models\Currencies;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Currencies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currencies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Currencies::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Currencies::ATTR_VALUE)->textInput() ?>

    <?= $form->field($model, Currencies::ATTR_ENABLED)->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить валюту', ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/currencies">Вернуться к списку валют</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>