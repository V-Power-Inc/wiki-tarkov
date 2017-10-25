<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prapor */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Prapors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prapor-view">

    <h1>Квест Прапора: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно хотите удалить этот квест?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content',
            'date_create',
            'date_edit',
        ],
    ]) ?>

    <a class="btn btn-primary" href="/admin/prapor">Вернуться в список квестов Прапора</a>
</div>
