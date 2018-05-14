<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Currencies */

$this->title = 'Создать новую валюту';
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currencies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
