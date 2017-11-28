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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить квест', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить квест', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить квест?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'preview',
            'content:ntext',
            'tab_number',
            'date_create',
            'date_edit',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/prapor/">Вернуться в список квестов Прапора</a>
</div>
