<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prapor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prapor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'date_edit')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить квест', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
