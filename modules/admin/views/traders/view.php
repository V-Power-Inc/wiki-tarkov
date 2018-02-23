<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Traders */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Traders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить торговца', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить торговца', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Функция удаления торговцев отключена, вы можете отключить торговца, чтобы не показывать на сайте, изменив галочку "Торговец ативен"',
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
            'urltoquets:url',
            'button_quests',
            'button_detail',
            'bg_style:ntext',
            'enabled',
        ],
    ]) ?>
    <a class="btn btn-primary" href="/admin/traders/index?dp-1-sort=sortir">Вернуться в список торговцев</a>
</div>
