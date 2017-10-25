<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lyjnic */

$this->title = 'Создание нового квеста Лыжника';
$this->params['breadcrumbs'][] = ['label' => 'Lyjnics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lyjnic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
