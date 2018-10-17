<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Clans */

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
