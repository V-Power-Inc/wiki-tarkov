<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PraporSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Квесты Прапора';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prapor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новый квест', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'tab_number',
            'title',
//            'content:ntext',
            'date_create',
            'date_edit',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
