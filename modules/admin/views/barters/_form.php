<?php

use yii\web\JqueryAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Barters */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('js/preview-barters.js', ['depends' => [JqueryAsset::class]]);

?>

<div class="barters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site_title')->textInput(['maxlength' => true]) ?>

    <label class="label label-info margin-bottom-20 adm">Название на сайте должно быть например следующим - LVL 1, или например LVL 2.</label>

    <!-- todo: Хардкод списки -->
    <?= $form->field($model, 'trader_group')->dropDownList([
            'Прапор' => 'Прапор',
            'Терапевт' => 'Терапевт',
            'Скупщик' => 'Скупщик',
            'Лыжник' => 'Лыжник',
            'Миротворец' => 'Миротворец',
            'Механик' => 'Механик',
            'Барахольщик' => 'Барахольщик',
            'Егерь' => 'Егерь'
        ])
    ?>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::class,[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, 'date_create')->textInput(['maxlength' => true, 'value'=>($model->date_create == Null)?date("Y-m-d H:i:s",time()):$model->date_create, 'disabled' => true]) ?>

    <?= $form->field($model, 'enabled')->checkbox([
        'label' => 'Включен',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить запись', ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/barters">Вернуться в список бартеров</a>

        <a class="btn btn-warning" id="preview-barters">Предпросмотр материала</a>
    </div>

    <?php ActiveForm::end(); ?>

    <!-- Форма для отображения превью -->
    <form id="prev-form-barters" action="/traders/barterspreview" method="post" target="blank">
        <input type="hidden" name="_csrf" value="">
        <input type="hidden" id="trader-id" name="Barters[id]">
        <input type="hidden" id="trader-title" name="Barters[title]">
        <input type="hidden" id="site-title" name="Barters[site_title]">
        <input type="hidden" id="trader" name="Barters[trader_group]">
        <input type="hidden" id="trader-content" name="Barters[content]">
    </form>


</div>
