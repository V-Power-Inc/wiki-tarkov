<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MapstaticcontentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Описания маркеров в правой колонке';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapstaticcontent-index">
 <!-- Пизда костыль -->   
    <style>
        .glyphicon.glyphicon-trash {
            display: none;
        }
    </style>
    

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
        <?// Html::a('Create Mapstaticcontent', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'content:ntext',
            'markername',

            ['class' => 'yii\grid\ActionColumn'],
            
        ],
        
    ]); ?>
</div>
