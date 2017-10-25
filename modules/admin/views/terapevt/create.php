<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Terapevt */

$this->title = 'Создать новый квест Терапевта';
$this->params['breadcrumbs'][] = ['label' => 'Terapevts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terapevt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
