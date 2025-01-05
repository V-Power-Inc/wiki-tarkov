<?php

use app\models\Skills;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder; // TODO: Это Deprecated пакет, нужна альтернатива
use app\models\Catskills;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Skills */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="skills-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Skills::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Skills::ATTR_CATEGORY)->dropDownList(ArrayHelper::map(Catskills::find()->all(), Skills::ATTR_ID, Skills::ATTR_TITLE)) ?>

    <?= $form->field($model, Skills::ATTR_URL)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Skills::FILE)->fileInput(['value' => $model->preview]) ?>
    
    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>

    <br>
    <br>

    <?= $form->field($model, Skills::ATTR_SHORT_DESC)->textarea(['rows' => 3]) ?>

    <?php  echo $form->field($model, Skills::ATTR_CONTENT)->widget(CKEditor::class,[
        // 'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, Skills::ATTR_DESCRIPTION)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Skills::ATTR_KEYWORDS)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Skills::ATTR_ENABLED)->checkbox([
        'label' => 'Умение активно',
    ]); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать умение' : 'Обновить умение', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/skills">Вернуться в список умений</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
