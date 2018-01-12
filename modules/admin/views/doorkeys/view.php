<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Doorkeys */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Doorkeys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doorkeys-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить ключ', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить ключ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот ключ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'mapgroup',
            'shortcontent:ntext',
            'content:ntext',
            'active',
            'date_create',
            'preview',
            'url',
            'description',
            'keywords',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/doorkeys/">Вернуться в справочник ключей</a>
</div>
