<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eger */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Egers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eger-update">

    <h1>Обновить квест Прапора: <?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
