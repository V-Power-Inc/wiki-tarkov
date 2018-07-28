<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Skypshik */

$this->title = 'Создать новый квест';
$this->params['breadcrumbs'][] = ['label' => 'Skypshiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skypshik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
