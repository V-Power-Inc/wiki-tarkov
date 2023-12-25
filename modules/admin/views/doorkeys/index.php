<?php

use app\models\Doorkeys;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DoorkeysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Справочник ключей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doorkeys-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новый ключ', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            Doorkeys::ATTR_ID,
            Doorkeys::ATTR_NAME,
            Doorkeys::ATTR_MAPGROUP,
            Doorkeys::ATTR_SHORTCONTENT . ':ntext',
            Doorkeys::ATTR_PREVIEW => [
                'format' => 'image',
                'value' => function($data) {
                    return $data->preview;
                },
            ],
            Doorkeys::ATTR_URL,

            ['class' => 'yii\grid\ActionColumn'],
        ],
        
        'tableOptions' => [
            'class' => 'table table-striped table-bordered customed'
        ]
    ]); ?>
</div>