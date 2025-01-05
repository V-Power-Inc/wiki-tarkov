<?php

use app\models\News;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder; // TODO: Это Deprecated пакет, нужна альтернатива

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, News::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, News::ATTR_URL)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, News::ATTR_DESCRIPTION)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, News::ATTR_KEYWORDS)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, News::FILE)->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>

    <br>
    <br>
    
    <?= $form->field($model, News::ATTR_SHORTDESC)->textarea(['rows' => 3]) ?>

    <?php  echo $form->field($model, News::ATTR_CONTENT)->widget(CKEditor::class,[
        // 'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, News::ATTR_DATE_CREATE)->widget(DatePicker::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, News::ATTR_ENABLED)->checkbox([
        'label' => 'Новость активна',
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать новость' : 'Обновить новость', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/news">Вернуться в список новостей</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
