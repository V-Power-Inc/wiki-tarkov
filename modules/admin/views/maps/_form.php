<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use app\models\Maps;

/* @var $this yii\web\View */
/* @var $model app\models\Maps */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('js/adminscript.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="maps-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'map')
        ->dropDownList(
            ArrayHelper::map(
                Maps::find()
                    ->groupBy(Maps::ATTR_MAP)
                    ->asArray()
                    ->all(),
                Maps::ATTR_MAP,
                Maps::ATTR_MAP
            ),
            ['options' => [$model->map => ['Selected' => 'selected']]]
        )
    ?>

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
        ],
            ['options' => [$model->marker_group => ['Selected' => 'selected']]]
        )
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
        ->dropDownList(
                ArrayHelper::map(
                Maps::find()
                    ->where(['is not', Maps::ATTR_EXITS_GROUP, null])
                    ->andWhere(['!=', Maps::ATTR_EXITS_GROUP, ''])
                    ->asArray()
                    ->all(),
                Maps::ATTR_EXITS_GROUP,
                Maps::ATTR_EXITS_GROUP
                ),
                ['options' => [$model->exits_group => ['Selected' => 'selected']]]
        )
    ?>

    <?= $form->field($model, 'coords_x')->textInput() ?>

    <?= $form->field($model, 'coords_y')->textInput() ?>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::class,[
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
        <a class="btn btn-primary" href="/admin/maps/">Вернуться в список маркеров</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>