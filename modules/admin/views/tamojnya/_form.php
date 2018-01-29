<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Tamojnya */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('js/adminscript.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="tamojnya-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marker_group')
        ->dropDownList([
            'Военные ящики' => 'Военные ящики',
            'Спавны диких' => 'Спавны диких',
            'Спавны игроков ЧВК' => 'Спавны игроков ЧВК',
            'Квестовые точки' => 'Квестовые точки',
            'Маркеры выходов' => 'Маркеры выходов',
            'Маркеры ключей' => 'Маркеры ключей',
            'Выходы за Диких' => 'Выходы за Диких',
            'Интересные места' => 'Интересные места',
        ])
    ?>

    <?= $form->field($model, 'file')->fileInput(['value' => $model->customicon]) ?>

    <?php if($model->customicon) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->customicon .' ?>';
    };
    ?>

    <br>
    <br>

    <?= $form->field($model, 'exits_group')
        ->dropDownList([
            'Спавн на гаражах' => 'Спавн на гаражах',
            'Спавн на бойлерах' => 'Спавн на бойлерах',
        ])
    ?>

    <?= $form->field($model, 'coords_x')->textInput() ?>

    <?= $form->field($model, 'coords_y')->textInput() ?>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, 'exit_anyway')->checkbox([
        'label' => 'Доступен для любого спавна ЧВК',
    ]); ?>

    <?= $form->field($model, 'enabled')->checkbox([
        'label' => 'Включен',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать маркер' : 'Обновить маркер', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/tamojnya/">Вернуться в список маркеров Таможни</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
