<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Forest */

$this->title = 'Создать новый маркер для интерактивной карты Леса';
$this->params['breadcrumbs'][] = ['label' => 'Forests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
