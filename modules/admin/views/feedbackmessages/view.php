<?php

use app\modules\admin\controllers\FeedbackmessagesController;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\FeedbackMessages */

$this->title = 'Заявка № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Feedback Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="feedback-messages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
            'date_create',
        ],
    ]) ?>

    <a class="btn btn-primary" href="<?= Url::to(FeedbackmessagesController::getUrlRoute(FeedbackmessagesController::ACTION_INDEX)) ?>">Вернуться в список обращений</a>
</div>