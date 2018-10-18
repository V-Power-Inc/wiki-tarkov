<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Clans */

$this->title = 'Обновить запись: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Clans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clans-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
