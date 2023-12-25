<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Barters;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BartersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список бартеров торговцев по уровням';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barters-index">

    <p class="alert alert-danger size-16"><b>Создавать записи нужно последоватьльно</b>, например если начали делать записи, <b>сначала нужно заполнить записи всех уровней конкретного торговца</b>, а только потом браться за другого - сортировка <b>по дате создания</b>.</p>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новую запись', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            Barters::ATTR_TITLE,
            Barters::ATTR_SITE_TITLE,
            [
                'attribute' => Barters::ATTR_TRADER_GROUP,
                'value' => Barters::ATTR_TRADER_GROUP,
                'filter' => Html::activeDropDownList($searchModel,Barters::ATTR_TRADER_GROUP, ArrayHelper::map(Barters::find()->asArray()->all(), Barters::ATTR_TRADER_GROUP, Barters::ATTR_TRADER_GROUP), ['class'=>'form-control','prompt'=>'Выберите группу маркера']),
            ],
            Barters::ATTR_DATE_CREATE,
            Barters::ATTR_ENABLED,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>