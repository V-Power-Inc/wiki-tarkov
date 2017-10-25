<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prapor */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Prapors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->title]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prapor-update">

    <h1>Обновить квест прапора: <?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
</div>
