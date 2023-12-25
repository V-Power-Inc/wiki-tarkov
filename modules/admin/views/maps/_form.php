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

    <?= $form->field($model, Maps::ATTR_NAME)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Maps::ATTR_MAP)
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

    <?= $form->field($model, Maps::ATTR_MARKER_GROUP)
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

    <?= $form->field($model, Maps::FILE)->fileInput(['value' => $model->customicon]) ?>

    <?php if($model->customicon) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->customicon .' ?>';
    };
    ?>

    <br>
    <br>

    <?= $form->field($model, Maps::ATTR_EXITS_GROUP)
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

    <?= $form->field($model, Maps::ATTR_COORDS_X)->textInput() ?>

    <?= $form->field($model, Maps::ATTR_COORDS_Y)->textInput() ?>

    <?php  echo $form->field($model, Maps::ATTR_CONTENT)->widget(CKEditor::class,[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, Maps::ATTR_EXIT_ANYWAY)->checkbox([
        'label' => 'Доступен для любого спавна ЧВК',
    ]); ?>

    <?= $form->field($model, Maps::ATTR_ENABLED)->checkbox([
        'label' => 'Включен',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать маркер' : 'Обновить маркер', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/maps/">Вернуться в список маркеров</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>