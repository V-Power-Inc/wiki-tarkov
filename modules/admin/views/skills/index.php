<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Catskills;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SkillsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список пассивных умений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новое умение', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',

            [
                'attribute' => 'category',
                'value' => 'category0.title',
                'filter' => Html::activeDropDownList($searchModel,'category',ArrayHelper::map(Catskills::find()->asArray()->all(), 'id', 'title'), ['class'=>'form-control','prompt'=>'Выберите группу маркера']),
            ],
            
            
            'url:url',
            'preview' => [
                'format' => 'image',
                'value' => function($data) {
                    return  $data->preview;
                },
            ],
            'enabled',
            // 'description',
            // 'keywords',
            // 'preview',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
