<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Maps;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MapsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Маркеры интерактивных карт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maps-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новый маркер', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            Maps::ATTR_NAME,
            [
                'attribute' => Maps::ATTR_MAP,
                'value' => Maps::ATTR_MAP,
                'filter' => Html::activeDropDownList($searchModel,Maps::ATTR_MAP,ArrayHelper::map(Maps::find()->asArray()->all(), Maps::ATTR_MAP, Maps::ATTR_MAP), ['class'=>'form-control','prompt'=>'Выберите локацию']),
            ],
            [
                'attribute' => Maps::ATTR_MARKER_GROUP,
                'value' => Maps::ATTR_MARKER_GROUP,
                'filter' => Html::activeDropDownList($searchModel,Maps::ATTR_MARKER_GROUP, ArrayHelper::map(Maps::find()->asArray()->all(), Maps::ATTR_MARKER_GROUP, Maps::ATTR_MARKER_GROUP), ['class'=>'form-control','prompt'=>'Выберите группу маркера']),
            ],
            Maps::ATTR_COORDS_X,
            Maps::ATTR_COORDS_Y,
            Maps::ATTR_CUSTOMICON => [
                'format' => 'image',
                'value' => function($data) {
                    return  $data->customicon;
                },
            ],
            Maps::ATTR_EXITS_GROUP,
            Maps::ATTR_EXIT_ANYWAY,

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
            'class' => 'table table-striped table-bordered customed'
        ],
    ]); ?>
</div>
