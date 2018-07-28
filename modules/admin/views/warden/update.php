<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Warden */

$this->title = 'Обновить квест: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Wardens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="warden-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
