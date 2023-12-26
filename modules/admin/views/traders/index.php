<?php

use app\models\Traders;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TradersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список торговцев Таркова';
$this->params['breadcrumbs'][] = $this->title;
?>

<br>

<div class="traders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="alert alert-danger size-16 margin-bottom-5">
        <b>Внимание</b> - ссылка на список квестов торговца должна выглядеть вот так: <b>/quests-of-traders/lyjnic-quests</b> - Нужно брать реально существующий адрес, иначе будет ссылка на несуществующую страницу и пользователи будут перенаправляться на несуществующую страницу.
        <br>
        <br>
        Ссылка на детальную страницу торговца - это одно слово на линтинском - пример: <b>prapor</b>
    </p>

    <span class="label label-important">Важные особенности работы!</span>

    <br>
    <br>
    
    <p>
        <?= Html::a('Создать нового торговца', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            Traders::ATTR_TITLE,
            Traders::ATTR_SORTIR,
            Traders::ATTR_PREVIEW => [
                'format' => 'image',
                'value' => function($data) {
                    return  $data->preview;
                },
            ],
            Traders::ATTR_CONTENT,
            Traders::ATTR_ENABLED,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
