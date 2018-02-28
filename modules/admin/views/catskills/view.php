<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Catskills */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Catskills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catskills-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить категорию', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить категорию', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить эту категорию?',
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
            'sortir',
            'url:url',
            'description',
            'keywords',
            'enabled',
            'preview',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/catskills">Вернуться в список категорий умений</a>
</div>
