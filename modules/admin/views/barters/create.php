<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Barters */

$this->title = 'Создание новой записи бартера';
$this->params['breadcrumbs'][] = ['label' => 'Barters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
