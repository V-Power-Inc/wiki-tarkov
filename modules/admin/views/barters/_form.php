<?php

use app\models\Barters;
use app\models\Traders;
use yii\web\JqueryAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Barters */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('js/preview-barters.js', ['depends' => [JqueryAsset::class]]);

?>

<div class="barters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Barters::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Barters::ATTR_SITE_TITLE)->textInput(['maxlength' => true]) ?>

    <label class="label label-info margin-bottom-20 adm">Название на сайте должно быть например следующим - LVL 1, или например LVL 2.</label>

    <?= $form->field($model, Barters::ATTR_TRADER_GROUP)->dropDownList(Traders::getTradersList(false)) ?>

    <?php  echo $form->field($model, Barters::ATTR_CONTENT)->widget(CKEditor::class,[
        // 'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, Barters::ATTR_DATE_CREATE)->textInput(['maxlength' => true, 'value'=>($model->date_create == Null)?date("Y-m-d H:i:s",time()):$model->date_create, 'disabled' => true]) ?>

    <?= $form->field($model, Barters::ATTR_ENABLED)->checkbox([
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