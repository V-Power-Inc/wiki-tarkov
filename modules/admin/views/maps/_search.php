<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MapsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="maps-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'map') ?>

    <?= $form->field($model, 'marker_group') ?>

    <?= $form->field($model, 'coords_x') ?>

    <?php // echo $form->field($model, 'coords_y') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'enabled') ?>

    <?php // echo $form->field($model, 'customicon') ?>

    <?php // echo $form->field($model, 'exits_group') ?>

    <?php // echo $form->field($model, 'exit_anyway') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
