<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Doorkeys */

$this->title = 'Создать новый ключ';
$this->params['breadcrumbs'][] = ['label' => 'Doorkeys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doorkeys-create"> 

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
