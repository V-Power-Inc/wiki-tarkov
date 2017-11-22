<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Zavod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zavod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'coords_voen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'voen_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
