<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Barters */

$this->title = 'Обновить бартер: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Barters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="barters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
