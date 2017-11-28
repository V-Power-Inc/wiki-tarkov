<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
// Надо сделать upload файлов с ресайзом - use yii\imagine;

/* @var $this yii\web\View */
/* @var $model app\models\Prapor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prapor-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tab_number')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, 'date_create')->textInput(['maxlength' => true, 'value'=>($model->date_create == Null)?date("Y-m-d H:i:s",time()):$model->date_create, 'disabled' => true]) ?>

    <?= $form->field($model, 'date_edit')->textInput(['maxlength' => true, 'value'=>date("Y-m-d H:i:s",time())]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить квест', ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/prapor">Вернуться в список квестов Прапора</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
