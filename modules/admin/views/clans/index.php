<?php

use app\models\Clans;
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

            [
                'attribute' => Clans::ATTR_TITLE,
                'format' => 'raw',
                'value' => function($active) {
                    return '<b>'.$active->title.'</b>';
                }
            ],
            Clans::ATTR_DESCRIPTION,
            'preview' => [
                'attribute' => Clans::ATTR_PREVIEW,
                'format' => 'image',
                'value' => function($data) {
                    return $data->preview;
                },
            ],
            Clans::ATTR_LINK . ':ntext',
            [
                'attribute' => Clans::ATTR_MODERATED,
                'format' => 'raw',
                'value' => function($active) {
                    if($active->moderated === Clans::TRUE) {
                        return '<label class="label label-success customed-labels-adm">Проверено</label>';
                    } else {
                        return '<label class="label label-danger customed-labels-adm">Не проверено</label>';
                    }
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
            'class' => 'table table-striped table-bordered customed'
        ],
    ]); ?>
</div>
