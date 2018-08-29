<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Barters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="barters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site_title')->textInput(['maxlength' => true]) ?>

    <label class="label label-info margin-bottom-20 adm">Название на сайте должно быть например следующим - LVL 1, или например LVL 2.</label>

    <?= $form->field($model, 'trader_group')
        ->dropDownList([
            'Прапор' => 'Прапор',
            'Терапевт' => 'Терапевт',
            'Скупщик' => 'Скупщик',
            'Лыжник' => 'Лыжник',
            'Миротворец' => 'Миротворец',
            'Механик' => 'Механик',
            'Барахольщик' => 'Барахольщик',
        ])
        // todo: Добавлять сюда торговцев по мере необходимости, когда они будут выходит
    ?>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::className(),[
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
    </div>

    <?php ActiveForm::end(); ?>

</div>
