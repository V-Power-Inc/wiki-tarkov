<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bashkir */

$this->title = 'Update Bashkir: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Bashkirs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bashkir-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
