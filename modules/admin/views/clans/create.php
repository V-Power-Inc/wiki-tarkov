<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var app\models\Clans $model */

$this->title = 'Create Clans';
$this->params['breadcrumbs'][] = ['label' => 'Clans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
