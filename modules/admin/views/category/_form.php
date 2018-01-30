<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <!-- В arrayMap проверяем - сделать более 3-х уровневое дерево категорий невозможно -->
    <?= $form->field($model, 'parent_category')->dropDownList(ArrayHelper::map(Category::find()->where(['parent_category' => null])->all(), 'id', 'title'), $params = ['prompt' => 'Не задано']) ?>

    <?= $form->field($model, 'sortir')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'url', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'enabled')->checkbox([
        'label' => 'Включен',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать новую категорию' : 'Изменить категорию', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/category/index?dp-1-sort=sortir">Вернуться в список категорий</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
