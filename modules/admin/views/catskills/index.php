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

    <p class="alert alert-danger size-16 margin-bottom-5">
        <b>Внимание</b> - чтобы удалить категорию скила, сначала надо удалить все привязанные к ней пассивные умения, <b>иначе удаление не произойдет.</b><br></p>
    <span class="label label-important">Важные особенности работы!</span>

    <br>
    <br>

    <p>
        <?= Html::a('Создать новую категорию', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
