<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha2;

$this->title = 'Авторизация';

$this->registerCssFile("css/particles.css", ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile('js/particles/particles.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/particles/part-custom.js', ['depends' => [\yii\web\JqueryAsset::class]]);

/** Вьюха с формой для авторизации пользователя и получения доступа к админке */
?>

<div class="site-login" style="padding: 60px 0; background: #ffffffd9; border-radius: 20px;">
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

    <?= $form->field($model, 'reCaptcha')->widget(
        ReCaptcha2::class,
        ['siteKey' => Yii::$app->params['recapchaSiteKey']]
    ) ?>

    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-11">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary w-200', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>