<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

use app\models\FeedbackMessages;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedbackMessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обратная связь с сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-messages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Текст об особенностях работы раздела -->
    <p class="alert alert-danger size-16 margin-bottom-10">Это <b>записи с формы обратной связи на сайте</b>, в этом разделе не предусмотрено создание новых записей</p>

    <!-- Вернуться на главную страницу -->
    <p>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            FeedbackMessages::ATTR_ID,
            FeedbackMessages::ATTR_CONTENT,
            [
                'attribute' => FeedbackMessages::ATTR_DATE_CREATE,
                'value' => FeedbackMessages::ATTR_DATE_CREATE,
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute'=> FeedbackMessages::ATTR_DATE_CREATE,
                    'language' => 'ru',
                    'dateFormat' => 'dd-MM-yyyy',
                ]),
                'format' => 'html',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>