<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clans */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Clans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clans-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот клан?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'preview',
            'link:ntext',
            'date_create',
            'moderated',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/clans">Вернуться в список заявок</a>
</div>
