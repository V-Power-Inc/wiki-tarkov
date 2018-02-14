<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Items;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список предметов справочника лута';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новый предмет', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'title',
            'preview' => [
                'format' => 'image',
                'value' => function($data) {
                    return $data->preview;
                },
            ],
            'shortdesc:ntext',
            // 'content:ntext',
            // 'date_create',
            // 'active',
            
            // Ниже узнаем по связи название родительской категории из связанной таблицы
            [
                'attribute' => 'parentcat_id',
                'value' => 'parentcat.title',
            ],

            
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
            'class' => 'table table-striped table-bordered customed'
        ],
    ]); ?>
</div>
