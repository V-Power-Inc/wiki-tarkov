<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var app\models\Traders $model */

$this->title = 'Создать нового торговца';
$this->params['breadcrumbs'][] = ['label' => 'Traders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
