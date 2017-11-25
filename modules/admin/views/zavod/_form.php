<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Zavod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zavod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'marker_group')
    ->dropDownList([
    'Военные ящики' => 'Военные ящики',
    'Спавны диких' => 'Спавны диких',
    'Офисные полки' => 'Офисные полки',
    'Маркеры выходов' => 'Маркеры выходов',
    'Маркеры ключей' => 'Маркеры ключей',
    ])
        ?>
    <?= $form->field($model, 'coords_x')->textInput() ?>

    <?= $form->field($model, 'coords_y')->textInput() ?>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, 'enabled')->checkbox([
        'label' => 'Включен',
    ]); ?>

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать маркер' : 'Обновить маркер', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/zavod/">Вернуться в список маркеров Завода</a>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
