<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var app\models\Doorkeys $model */

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
