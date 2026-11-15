<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Traders $model */

$this->title = 'Обновить торговца: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Traders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="traders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
