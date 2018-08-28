<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Barters */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Barters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'date_create',
            'enabled',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/barters/">Вернуться в список бартеров</a>
</div>
