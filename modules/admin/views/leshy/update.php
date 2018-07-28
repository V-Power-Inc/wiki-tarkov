<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Leshy */

$this->title = 'Обновить квест: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Leshies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="leshy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
