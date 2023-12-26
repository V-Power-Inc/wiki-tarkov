<?php

use app\models\Catskills;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Catskills */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catskills-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Catskills::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Catskills::ATTR_BG_STYLE)
        ->dropDownList([
            'interback-white' => 'Белый фон',
            'interback-grey' => 'Серый фон',
        ])
    ?>


    <?= $form->field($model, Catskills::ATTR_SORTIR)->textInput() ?>

    <?= $form->field($model, Catskills::ATTR_URL)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Catskills::FILE)->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>

    <br>
    <br>

    <?php  echo $form->field($model, Catskills::ATTR_CONTENT)->widget(CKEditor::class,[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, Catskills::ATTR_DESCRIPTION)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Catskills::ATTR_KEYWORDS)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Catskills::ATTR_ENABLED)->checkbox([
        'label' => 'Категория активна',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать категорию' : 'Обновить категорию', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/catskills">Вернуться в список категорий умений</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>