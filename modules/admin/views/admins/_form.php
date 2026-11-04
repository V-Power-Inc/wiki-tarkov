<?php

use app\models\Admins;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admins */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admins-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Admins::ATTR_USER)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Admins::ATTR_NAME)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Admins::ATTR_ROLE)->textarea(['rows' => 2]) ?>

    <?= $form->field($model, Admins::ATTR_NEW_PASSWORD)
        ->passwordInput(['autocomplete' => 'new-password', 'maxlength' => Admins::PASSWORD_MAX_LENGTH])
        ->hint($model->isNewRecord
            ? 'От ' . Admins::PASSWORD_MIN_LENGTH . ' до ' . Admins::PASSWORD_MAX_LENGTH . ' символов.'
            : 'Оставьте пустым, чтобы не менять пароль.') ?>

    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, Admins::ATTR_BANNED)->checkbox() ?>

        <?= $form->field($model, Admins::ATTR_BANN_REASON)->textInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить администратора', ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/admins">Вернуться к списку администраторов</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
