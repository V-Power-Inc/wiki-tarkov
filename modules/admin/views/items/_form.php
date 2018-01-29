<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parentcat_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'file')->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>

    <br>
    <br>

    <?= $form->field($model, 'shortdesc')->textarea(['rows' => 3]) ?>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, 'date_create')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'active')->checkbox([
        'label' => 'Предмет активен',
    ]); ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать новый предмет' : 'Обновить существующий предмет', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/items/">Вернуться в список предметов</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
