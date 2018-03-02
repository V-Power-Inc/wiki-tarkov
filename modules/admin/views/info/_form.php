<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Info */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="info-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Если объект является курсом биткоина -->
<?php if($model->id == 1) { ?>

    <?= $form->field($model, 'file')->fileInput(['value' => $model->preview]) ?>

    <?php if($model->preview) {
        echo '<span style="font-weight: bold;">Текущее изображение:</span><br>';
        echo '<img src='. $model->preview .' ?>';
    };
    ?>
    <br>
    <br>

    <?= $form->field($model, 'course')->textInput() ?>

    <?= $form->field($model, 'enabled')->checkbox([
        'label' => 'Включен',
    ]); ?>

    <!-- Если объект является виджетом предупреждения в Таркове -->
<?php } elseif($model->id == 2) { ?>

    <?= $form->field($model, 'content')->textInput() ?>

    <?= $form->field($model, 'bgstyle')
        ->dropDownList([
            'tarkov-alert' => 'Красное предупреждение',
            'tarkov-good' => 'Зеленое предупреждение',
        ])
    ?>

    <?= $form->field($model, 'enabled')->checkbox([
        'label' => 'Включен',
    ]); ?>

<?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/info/">Вернуться в список инфо. виджетов</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
