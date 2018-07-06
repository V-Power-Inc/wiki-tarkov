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

$this->registerJsFile('js/adminscript.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/preview.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parentcat_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title')) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' class="existed-photo" style="max-width: 100%;" ?>';
    };
    ?>

    <br>
    <br>

    <?= $form->field($model, 'shortdesc')->textarea(['rows' => 3]) ?>

    <?php  echo $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, 'quest_item')->checkbox([
        'label' => 'Квестовый предмет',
    ]); ?>

    <?= $form->field($model, 'trader_group')
        ->listBox([
            'Прапор' => 'Прапор',
            'Терапевт' => 'Терапевт',
            'Лыжник' => 'Лыжник',
            'Миротворец' => 'Миротворец',
            'Скупщик' => 'Скупщик',
            'Механик' => 'Механик',
            'Барахольщик' => 'Барахольщик'
        ],
            [
                'multiple' => true,
                'style' => 'height: 115px',
            ]); ?>

    <?= $form->field($model, 'search_words')->textInput(['maxlength' => true])->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'module_weapon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_create')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'active')->checkbox([
        'label' => 'Предмет активен',
    ]); ?>

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать новый предмет' : 'Обновить существующий предмет', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <a class="btn btn-warning" id="preview-print">Предпросмотр материала</a>

        <a class="btn btn-primary" href="/admin/items/">Вернуться в список предметов</a>
    </div>

    <?php ActiveForm::end(); ?>
    
    <!-- Форма для отображения превью -->
    <form id="prev-form" action="/item/preview" method="post" target="blank">
        <input type="hidden" id="text-title" name="Items[title]">
        <input type="hidden" id="text-preview" name="Items[preview]" value = '<?=$model->preview?>'>
        <input type="hidden" id="text-content" name="Items[content]">
    </form>

</div>
