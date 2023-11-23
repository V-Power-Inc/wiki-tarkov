<?php

use app\models\FeedbackMessages;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FeedbackMessages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-messages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, FeedbackMessages::ATTR_CONTENT)->textarea(['rows' => 6]) ?>

    <?= $form->field($model, FeedbackMessages::ATTR_DATE_CREATE)->textInput() ?>

    <?php ActiveForm::end(); ?>
</div>