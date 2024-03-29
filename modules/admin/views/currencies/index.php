<?php

use app\models\Currencies;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurrenciesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список валют';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currencies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новую валюту', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            Currencies::ATTR_ID,
            Currencies::ATTR_TITLE,
            Currencies::ATTR_VALUE,
            Currencies::ATTR_ENABLED,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
