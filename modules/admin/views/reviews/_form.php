<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'admin_review')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'enabled')->checkbox([
        'label' => 'Включен',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить отзыв', ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/reviews">Вернуться в список отзывов</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
