<?php

use app\models\Questions;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder; // TODO: Это Deprecated пакет, нужна альтернатива

/* @var $this yii\web\View */
/* @var $model app\models\Questions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Questions::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?php  echo $form->field($model, Questions::ATTR_CONTENT)->widget(CKEditor::class,[
        // 'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, Questions::ATTR_DATE_CREATE)->textInput(['maxlength' => true, 'value'=>($model->date_create == Null)?date("Y-m-d H:i:s",time()):$model->date_create, 'disabled' => true]) ?>

    <?= $form->field($model, Questions::ATTR_ENABLED)->checkbox([
        'label' => 'Включен',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Создать новый вопрос-ответ', ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/questions">Вернуться в список вопросов и ответов</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
