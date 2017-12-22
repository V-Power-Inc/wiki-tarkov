<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Forest */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Forests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forest-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот маркер?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'marker_group',
            'coords_x',
            'coords_y',
            'content:ntext',
            'enabled',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/forest/">Вернуться в список маркеров Леса</a>
</div>
