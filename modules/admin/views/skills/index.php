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


    <p class="alert alert-danger size-16 margin-bottom-5">
        <b>Внимание</b> - Если умение отключено, оно будет выведено в списке умений на сайте, но перейти на его детальную страницу будет нельзя, также будет написано что умение еще не доступно в игре.</p>
    <span class="label label-important">Важные особенности работы!</span>

    <br>
    <br>
    
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

            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>
</div>
