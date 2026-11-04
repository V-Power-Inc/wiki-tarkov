<?php

use app\models\Admins;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Администраторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admins-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать администратора', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            Admins::ATTR_ID,
            Admins::ATTR_USER,
            Admins::ATTR_NAME,
            Admins::ATTR_ROLE,
            [
                'attribute' => Admins::ATTR_BANNED,
                'value' => static fn(Admins $model) => (int) $model->banned === Admins::ATTR_BANNED_TRUE ? 'Да' : 'Нет',
            ],

            /** Удаление отключено - только просмотр и редактирование */
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
