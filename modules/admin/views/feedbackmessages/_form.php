<?php

use app\models\FeedbackMessages;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FeedbackMessages $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="feedback-messages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, FeedbackMessages::ATTR_CONTENT)->textarea(['rows' => 6]) ?>

    <?= $form->field($model, FeedbackMessages::ATTR_DATE_CREATE)->textInput() ?>

    <?php ActiveForm::end(); ?>
</div>