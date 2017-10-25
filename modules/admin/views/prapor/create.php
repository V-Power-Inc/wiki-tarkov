<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prapor */

$this->title = 'Создать новый квест';
$this->params['breadcrumbs'][] = ['label' => 'Prapors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prapor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
