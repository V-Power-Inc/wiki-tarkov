<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Авторизация';

?>
<div class="site-login">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Для авторизации ввести e-mail и пароль.</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"col-lg-offset-4 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-3\">{error}</div>",
    ]) ?>

    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-11">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary w-200', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
