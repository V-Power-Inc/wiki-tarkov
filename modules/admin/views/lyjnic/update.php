<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lyjnic */

$this->title =  $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Lyjnics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lyjnic-update">

    <h1>Обновить квест Лыжника: <?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
