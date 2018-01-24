<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tamojnya */

$this->title = 'Создать новый маркер для интерактивной карты Таможни';
$this->params['breadcrumbs'][] = ['label' => 'Tamojnyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tamojnya-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
