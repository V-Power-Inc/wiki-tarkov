<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Admins */

$this->title = 'Редактировать администратора: ' . $model->user;
$this->params['breadcrumbs'][] = ['label' => 'Администраторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="admins-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
