<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Traders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="traders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bg_style')
        ->dropDownList([
            'interback-white' => 'Белый фон',
            'interback-grey' => 'Серый фон',
        ])
    ?>

    <?= $form->field($model, 'sortir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>

    <br>
    <br>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full', 'height' => '200']),
    ]);
    ?>

    <?php  echo $form->field($model, 'fullcontent')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>
    
    <h3 style="color: green;">Раздел квестов торговца:</h3>
    <div class="custom-admin-div">
        <?= $form->field($model, 'urltoquets')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'button_quests')->textInput(['maxlength' => true]) ?>
    </div>

    <h3 style="color: green;">Детальный раздел торговца:</h3>
    
    <div class="custom-admin-div">
        <?= $form->field($model, 'button_detail')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    </div>
        
    <br>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
        
    <?= $form->field($model, 'enabled')->checkbox([
        'label' => 'Торговец активен',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать торговца' : 'Обновить торговца', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/traders/index?dp-1-sort=sortir">Вернуться в список Торговцев</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
