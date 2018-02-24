<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CatskillsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории скилов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catskills-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новую категорию', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'title',
            'content:ntext',
            'sortir',
            'preview' => [
                'format' => 'image',
                'value' => function($data) {
                    return  $data->preview;
                },
            ],
            'url:url',
            // 'description',
            // 'keywords',
            // 'enabled',
            // 'preview',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
