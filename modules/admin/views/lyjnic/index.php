<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LyjnicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Квесты Лыжника';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lyjnic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новый квест Лыжника', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'tab_number',
            'title',
            'content:ntext',
            'date_create',
            // 'date_edit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
