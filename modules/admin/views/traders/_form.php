<?php

use app\models\Traders;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder; // TODO: Это Deprecated пакет, нужна альтернатива

/* @var $this yii\web\View */
/* @var $model app\models\Traders */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('js/preview-traders.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<p class="alert alert-danger size-16 margin-bottom-5">
    <b>Внимание</b> - ссылка на список квестов торговца должна выглядеть вот так: <b>/quests-of-traders/lyjnic-quests</b> - Нужно брать реально существующий адрес, иначе будет ссылка на несуществующую страницу и пользователи будут перенаправляться на несуществующую страницу.
    <br>
    <br>
    Ссылка на детальную страницу торговца - это одно слово на линтинском - пример: <b>prapor</b>
</p>

<span class="label label-important">Важные особенности работы!</span>

<br>
<br>

<div class="traders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Traders::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Traders::ATTR_BG_STYLE)
        ->dropDownList([
            'interback-white' => 'Белый фон',
            'interback-grey' => 'Серый фон',
        ])
    ?>

    <?= $form->field($model, Traders::ATTR_SORTIR)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Traders::FILE)->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' class="existed-photo" ?>';
    };
    ?>

    <br>
    <br>

    <?php  echo $form->field($model, Traders::ATTR_CONTENT)->widget(CKEditor::class,[
        // 'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full', 'height' => '200']),
    ]);
    ?>

    <?php  echo $form->field($model, Traders::ATTR_FULLCONTENT)->widget(CKEditor::class,[
        // 'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>
    
    <h3 style="color: green;">Раздел квестов торговца:</h3>
    <div class="custom-admin-div">
        <?= $form->field($model, Traders::ATTR_URLTOQUETS)->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, Traders::ATTR_BUTTON_QUESTS)->textInput(['maxlength' => true]) ?>
    </div>

    <h3 style="color: green;">Детальный раздел торговца:</h3>
    
    <div class="custom-admin-div">
        <?= $form->field($model, Traders::ATTR_BUTTON_DETAIL)->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, Traders::ATTR_URL)->textInput(['maxlength' => true]) ?>
    </div>
        
    <br>

    <?= $form->field($model, Traders::ATTR_DESCRIPTION)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Traders::ATTR_KEYWORDS)->textInput(['maxlength' => true]) ?>
        
    <?= $form->field($model, Traders::ATTR_ENABLED)->checkbox([
        'label' => 'Торговец активен',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать торговца' : 'Обновить торговца', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-warning" id="preview-print">Предпросмотр материала</a>
        <a class="btn btn-primary" href="/admin/traders/index?dp-1-sort=sortir">Вернуться в список Торговцев</a>

    </div>

    <?php ActiveForm::end(); ?>


    <!-- Форма для отображения превью -->
    <form id="prev-form" action="/traders/previewtrader" method="post" target="blank">
        <input type="hidden" id="text-title" name="Traders[title]">
        <input type="hidden" id="text-preview" name="Traders[preview]" value = '<?=$model->preview?>'>
        <input type="hidden" id="text-content" name="Traders[content]">
        <input type="hidden" id="text-url" name="Traders[urltoquets]">
        <input type="hidden" id="text-button" name="Traders[button_quests]">
        <input type="hidden" id="text-button-detail" name="Traders[button_detail]">
        <input type="hidden" id="text-fullcontent" name="Traders[fullcontent]">
    </form>

</div>
