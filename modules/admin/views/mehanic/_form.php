<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Mehanic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mehanic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tab_number')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>

    <br>
    <br>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, 'date_create')->textInput(['maxlength' => true, 'value'=>($model->date_create == Null)?date("Y-m-d H:i:s",time()):$model->date_create, 'disabled' => true]) ?>

    <?= $form->field($model, 'date_edit')->textInput(['maxlength' => true, 'value'=>date("Y-m-d H:i:s",time())]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить квест' : 'Обновить квест', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/mehanic">Вернуться в список квестов Механика</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
