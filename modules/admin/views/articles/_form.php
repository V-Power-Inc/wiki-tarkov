<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>

    <br>
    <br>

    <?= $form->field($model, 'shortdesc')->textarea(['rows' => 3]) ?>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::class,[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, 'date_create')->widget(\yii\jui\DatePicker::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <!-- Виджет datePicker тестируется - ниже стабильная строка для вывода даты -->
    <?php // $form->field($model, 'date_create')->textInput(['maxlength' => true, 'value'=>($model->date_create == Null)?date("Y-m-d H:i:s",time()):$model->date_create, 'disabled' => false]) ?>

    <?= $form->field($model, 'enabled')->checkbox([
        'label' => 'Статья активна',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать полезную статью' : 'Обновить полезную статью', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/articles/">Вернуться в список полезных статей</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
