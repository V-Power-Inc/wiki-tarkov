<?php

use app\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Category::ATTR_TITLE)->textInput(['maxlength' => true]) ?>

    <!-- В arrayMap проверяем - сделать более 3-х уровневое дерево категорий невозможно -->
    <?= $form->field($model, Category::ATTR_PARENT_CATEGORY)->dropDownList(ArrayHelper::map(Category::find()->where([Category::ATTR_PARENT_CATEGORY => null])->all(), Category::ATTR_ID, Category::ATTR_TITLE), $params = ['prompt' => 'Не задано']) ?>

    <?= $form->field($model, Category::ATTR_SORTIR)->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, Category::ATTR_URL, ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Category::ATTR_CONTENT)->textarea(['rows' => 3]) ?>

    <?= $form->field($model, Category::ATTR_DESCRIPTION)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Category::ATTR_KEYWORDS)->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, Category::ATTR_ENABLED)->checkbox([
        'label' => 'Включен',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать новую категорию' : 'Изменить категорию', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/category/index?dp-1-sort=sortir">Вернуться в список категорий</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>