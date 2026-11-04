<?php

use app\models\Admins;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Admins */

$this->title = 'Администратор: ' . $model->user;
$this->params['breadcrumbs'][] = ['label' => 'Администраторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admins-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-default" href="/admin/admins">Вернуться к списку администраторов</a>
    </p>

    <?php /** Хеш пароля намеренно не выводим */ ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            Admins::ATTR_ID,
            Admins::ATTR_USER,
            Admins::ATTR_NAME,
            Admins::ATTR_ROLE . ':ntext',
            [
                'attribute' => Admins::ATTR_BANNED,
                'value' => (int) $model->banned === Admins::ATTR_BANNED_TRUE ? 'Да' : 'Нет',
            ],
            Admins::ATTR_BANN_REASON,
            Admins::ATTR_DATE_END,
        ],
    ]) ?>

</div>
