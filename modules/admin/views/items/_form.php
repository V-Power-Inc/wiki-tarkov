<?php

use app\models\Items;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder; // TODO: Это Deprecated пакет, нужна альтернатива
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Items */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('js/adminscript.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('js/preview.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Items::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Items::ATTR_PARENTCAT_ID)->dropDownList(ArrayHelper::map(Category::find()->all(), Items::ATTR_ID, Items::ATTR_TITLE)) ?>

    <?= $form->field($model, Items::ATTR_URL)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Items::ATTR_DESCRIPTION)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Items::ATTR_KEYWORDS)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Items::FILE)->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' class="existed-photo" style="max-width: 100%;" ?>';
    };
    ?>

    <br>
    <br>

    <?= $form->field($model, Items::ATTR_SHORTDESC)->textarea(['rows' => 3]) ?>

    <?php  echo $form->field($model, Items::ATTR_CONTENT)->widget(CKEditor::class,[
        // 'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, Items::ATTR_QUEST_ITEM)->checkbox([
        'label' => 'Квестовый предмет',
    ]); ?>

    <?= $form->field($model, Items::ATTR_TRADER_GROUP)
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

    <?= $form->field($model, Items::ATTR_SEARCH_WORDS)->textInput(['maxlength' => true])->textarea(['rows' => 6]) ?>

    <?= $form->field($model, Items::ATTR_DATE_CREATE)->textInput(['disabled' => true]) ?>

    <?= $form->field($model, Items::ATTR_ACTIVE)->checkbox([
        'label' => 'Предмет активен',
    ]); ?>

    <?= $form->field($model, Items::ATTR_CREATOR)->hiddenInput(['value' => ($model->creator !== Null)?$model->creator:Yii::$app->user->identity->name])->label('') ?>
    
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