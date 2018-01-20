<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mehanic */

$this->title = 'Update Mehanic: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mehanics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mehanic-update">

    <h1>Обновить квест Механика: <?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
