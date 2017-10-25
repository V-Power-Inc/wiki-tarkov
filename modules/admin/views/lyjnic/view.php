<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lyjnic */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Lyjnics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lyjnic-view">

    <h1>Обновить квест Лыжника: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить квест', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить квест', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот квест?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tab_number',
            'title',
            'content:ntext',
            'date_create',
            'date_edit',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/lyjnic/">Вернуться в список квестов Лыжника</a>
</div>
