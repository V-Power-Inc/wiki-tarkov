<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Terapevt */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Terapevts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terapevt-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'preview',
            'content:ntext',
            'date_create',
            'date_edit',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/terapevt">Вернуться в список квестов Терапевта</a>
</div>
