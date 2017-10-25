<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Terapevt */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Terapevts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="terapevt-update">

    <h1>Обновить квест Терапевта: <?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
