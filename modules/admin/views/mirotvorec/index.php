<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MirotvorecSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mirotvorecs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mirotvorec-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mirotvorec', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tab_number',
            'title',
            'content:ntext',
            'date_create',
            // 'date_edit',
            // 'preview',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
