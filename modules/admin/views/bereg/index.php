<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Bereg;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BeregSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Маркеры интерактивной карты локации Берег';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bereg-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новый маркер', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'marker_group',
                'value' => 'marker_group',
                'filter' => Html::activeDropDownList($searchModel,'marker_group',ArrayHelper::map(Bereg::find()->asArray()->all(), 'marker_group', 'marker_group'), ['class'=>'form-control','prompt'=>'Выберите группу маркера']),
            ],
            'coords_x',
            'coords_y',
            'customicon' => [
                'format' => 'image',
                'value' => function($data) {
                    return  $data->customicon;
                },
            ],
            'exits_group',
            'exit_anyway',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
