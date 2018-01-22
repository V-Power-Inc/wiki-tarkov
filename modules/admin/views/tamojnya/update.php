<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tamojnya */

$this->title = 'Update Tamojnya: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tamojnyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tamojnya-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
