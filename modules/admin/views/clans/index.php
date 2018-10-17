<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClansSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки на регистрацию клана';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clans-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'preview',
            'link:ntext',
            //'date_create',
            //'moderated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
