<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Razvyazka */

$this->title = 'Создать новый маркер для карты Развязки';
$this->params['breadcrumbs'][] = ['label' => 'Razvyazkas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="razvyazka-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
