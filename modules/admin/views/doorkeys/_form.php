<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Doorkeys */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doorkeys-form"> 

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'mapgroup')
    ->listBox([
        'Таможня' => 'Таможня',
        'Лес' => 'Лес',
        'Берег' => 'Берег',
        'Завод' => 'Завод',
    ],
    [
    'multiple' => true,
    ]);

   ?>

    <?= $form->field($model, 'file')->fileInput(['value' => $model->preview]) ?>
    

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
        echo '<br>';
        echo '<br>';
    };
    ?>
    

    <?php  echo $form->field($model, 'shortcontent')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full', 'height' => '100']),
    ]);
    ?>

    <br>
    <br>
    
    <?php  echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <br>
    
    <?= $form->field($model, 'active')->checkbox([
        'label' => 'Включен',
    ]); ?>

    <?= $form->field($model, 'date_create')->textInput(['maxlength' => true, 'value'=>($model->date_create == Null)?date("Y-m-d H:i:s",time()):$model->date_create, 'disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать новый ключ' : 'Обновить ключ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/doorkeys">Вернуться в справочник ключей</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
