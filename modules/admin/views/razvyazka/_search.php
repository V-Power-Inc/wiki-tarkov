<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RazvyazkaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="razvyazka-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'marker_group') ?>

    <?= $form->field($model, 'coords_x') ?>

    <?= $form->field($model, 'coords_y') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'enabled') ?>

    <?php // echo $form->field($model, 'customicon') ?>

    <?php // echo $form->field($model, 'exits_group') ?>

    <?php // echo $form->field($model, 'exit_anyway') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
