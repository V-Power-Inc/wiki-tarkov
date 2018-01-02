<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mirotvorec */

$this->title = 'Update Mirotvorec: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mirotvorecs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mirotvorec-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
