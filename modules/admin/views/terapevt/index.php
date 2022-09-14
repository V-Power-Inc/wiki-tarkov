<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TerapevtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Квесты Терапевта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terapevt-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новый квест', ['create'], ['class' => 'btn btn-success']) ?>

        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'tab_number',
            'title',
            'preview' => [
                'format' => 'image',
                'value' => function($data) {
                    return  $data->preview;
                },
            ],
            'date_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],

        'tableOptions' => [
            'class' => 'table table-striped table-bordered customed'
        ],
    ]); ?>
</div>
