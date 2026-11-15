<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Maps $model */

$this->title = 'Создать новый маркер для интерактивной карты';
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maps-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
