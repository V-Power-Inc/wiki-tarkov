<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список категорий справочника лута';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p class="alert alert-danger size-16 margin-bottom-5"><b>Внимание</b> - чтобы удалить корневую категорию, сначала надо удалить все дочерние, <b>иначе удаление не произойдет.</b></p>
    <span class="label label-important">Важная особенность!</span>
    
    <br>
    <br>
    <br>
    
    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'parent_category',
            'url:url',
            'sortir',
            // 'description',
            // 'enabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
