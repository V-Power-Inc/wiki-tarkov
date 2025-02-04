<?php

use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use mihaildev\ckeditor\CKEditor;
use app\modules\admin\controllers\ArticlesController;
use app\models\Articles;

/* @var $this View - Объект View */
/* @var $model Articles - Объект AR - Полезная статья */
/* @var $form ActiveForm - Объект ActiveForm */
?>
<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Articles::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Articles::ATTR_URL)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Articles::ATTR_DESCRIPTION)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Articles::ATTR_KEYWORDS)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Articles::FILE)->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>

    <br>
    <br>

    <?= $form->field($model, Articles::ATTR_SHORTDESC)->textarea(['rows' => 3]) ?>

    <?php  echo $form->field($model, Articles::ATTR_CONTENT)->widget(CKEditor::class,[
        // 'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '/'],['preset' => 'full']),
    ]);
    ?>

    <?= $form->field($model, Articles::ATTR_DATE_CREATE)->widget(DatePicker::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, Articles::ATTR_ENABLED)->checkbox([
        'label' => 'Статья активна',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать полезную статью' : 'Обновить полезную статью', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="<?= Url::to(ArticlesController::getUrlRoute(ArticlesController::ACTION_INDEX)) ?>">Вернуться в список полезных статей</a>
    </div>

    <?php ActiveForm::end(); ?>
</div>