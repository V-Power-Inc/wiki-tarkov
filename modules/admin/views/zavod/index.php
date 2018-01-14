<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZavodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Маркеры интерактивной карты локации Завод';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zavod-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новый маркер', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'marker_group',
            'coords_x',
            'coords_y',
            'customicon' => [
                'format' => 'image',
                'value' => function($data) {
                    return  $data->customicon;
                },
            ],
            // 'content:ntext',
            // 'enabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],

        'tableOptions' => [
            'class' => 'table table-striped table-bordered customed'
        ],
    ]); ?>
</div>
