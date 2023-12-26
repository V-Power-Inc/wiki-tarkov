<?php

use app\models\Questions;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список вопросов и ответов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новый вопрос и ответ', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            Questions::ATTR_ID,
            Questions::ATTR_TITLE,
            Questions::ATTR_CONTENT . ':ntext',
            Questions::ATTR_DATE_CREATE,
            Questions::ATTR_ENABLED,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
