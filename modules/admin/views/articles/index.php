<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Articles;
use app\modules\admin\controllers\DefaultController;
use app\modules\admin\controllers\ArticlesController;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список полезных статей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новую полезную статью', [ArticlesController::ACTION_CREATE], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="<?= Url::to(DefaultController::getUrlRoute(DefaultController::ACTION_INDEX)) ?>">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            Articles::ATTR_TITLE,
            Articles::ATTR_PREVIEW => [
                'format' => 'image',
                'value' => function($data) {
                    return  $data->preview;
                },
            ],
            Articles::ATTR_DATE_CREATE,
            Articles::ATTR_ENABLED,

            ['class' => 'yii\grid\ActionColumn'],
        ],

        'tableOptions' => [
            'class' => 'table table-striped table-bordered customed'
        ],
    ]); ?>
</div>