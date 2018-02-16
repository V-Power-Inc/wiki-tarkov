<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bereg */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Beregs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bereg-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить маркер', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить маркер', ['delete', 'id' => $model->id], [
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
            'customicon',
            'exits_group',
            'exit_anyway',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/bereg/">Вернуться в список маркеров Берега</a>
</div>
