<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reviews */

$this->title = 'Создать новый отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
