<?php

use app\models\Doorkeys;
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

    <?= $form->field($model, Doorkeys::ATTR_NAME)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Doorkeys::ATTR_URL)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Doorkeys::ATTR_DESCRIPTION)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Doorkeys::ATTR_KEYWORDS)->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, Doorkeys::ATTR_MAPGROUP)
    ->listBox([
        'Лаборатория Terra Group' => 'Лаборатория Terra Group',
        'Таможня' => 'Таможня',
        'Лес' => 'Лес',
        'Берег' => 'Берег',
        'Завод' => 'Завод',
        'Развязка' => 'Развязка',
        '3-х этажная общага на Таможне' => '3-х этажная общага на Таможне',
        '2-х этажная общага на Таможне' => '2-х этажная общага на Таможне',
        'Восточное крыло санатория' => 'Восточное крыло санатория',
        'Западное крыло санатория' => 'Западное крыло санатория',
        'Ключи от техники' => 'Ключи от техники',
        'Квестовые ключи' => 'Квестовые ключи',
        'Ключи от сейфов/помещений с сейфами' => 'Ключи от сейфов/помещений с сейфами',
    ],
    [
    'multiple' => true,
    ]);

   ?>

    <?= $form->field($model, Doorkeys::FILE)->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
        echo '<br>';
        echo '<br>';
    };
    ?>

    <?php  echo $form->field($model, Doorkeys::ATTR_SHORTCONTENT)->widget(CKEditor::class,[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full', 'height' => '100']),
    ]);
    ?>

    <br>
    <br>
    
    <?php  echo $form->field($model, Doorkeys::ATTR_CONTENT)->widget(CKEditor::class,[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <br>
    
    <?= $form->field($model, Doorkeys::ATTR_ACTIVE)->checkbox([
        'label' => 'Включен',
    ]); ?>

    <?= $form->field($model, Doorkeys::ATTR_DATE_CREATE)->textInput(['maxlength' => true, 'value'=>($model->date_create == Null)?date("Y-m-d H:i:s",time()):$model->date_create, 'disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать новый ключ' : 'Обновить ключ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/doorkeys">Вернуться в справочник ключей</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>