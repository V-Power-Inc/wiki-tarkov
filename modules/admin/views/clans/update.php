<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Clans $model */

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
