<?php

use app\models\Clans;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clans */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clans-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, Clans::ATTR_TITLE)->textInput(['maxlength' => true, 'placeholder' => 'Название клана']) ?>

    <?= $form->field($model, Clans::ATTR_DESCRIPTION)->textInput(['maxlength' => true, 'placeholder' => 'Описание клана']) ?>

    <?= $form->field($model, Clans::FILE)->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>

    <?= $form->field($model, Clans::ATTR_LINK)->textInput(['maxlength' => true, 'placeholder' => 'Ссылка на сообщество или сайт']) ?>

    <?= $form->field($model, Clans::ATTR_DATE_CREATE)->textInput(['maxlength' => true, 'placeholder' => 'Дата создания', 'value'=>($model->date_create == Null)?date("Y-m-d H:i:s",time()):$model->date_create, 'disabled' => true]) ?>
    
    <?= $form->field($model, Clans::ATTR_MODERATED)->checkbox([
        'label' => 'Заявка одобрена',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить данные', ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/clans">Вернуться в список заявок</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>