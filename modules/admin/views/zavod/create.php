<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Zavod */

$this->title = 'Создать новый маркер для интерактивной карты Завода';
$this->params['breadcrumbs'][] = ['label' => 'Zavods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zavod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
</div>
