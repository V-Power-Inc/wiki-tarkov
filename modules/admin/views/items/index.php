<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список предметов справочника лута';
$this->params['breadcrumbs'][] = $this->title;

/*** Массив значений справочника лута для вывода разного количества записей ***/
$values = [10,15, 25, 50, 75, 100, 150, 200, 250, 500];

if(isset($_GET['per-page']) && is_numeric($_GET['per-page'])) {
    $dataProvider->pagination->pageSize=$_GET['per-page'];
} else {
    $dataProvider->pagination->pageSize=10;
}

?>

<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новый предмет', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>

    <div class="margins-vertical-20 custom-items-list-search">
        <label>Выберите количество записей для отображения:</label>
        <select class="form-control" onchange="location = this.value;">
            <?php foreach ($values as $value): ?>
                <option value="<?= Html::encode(Url::current(['per-page' => $value, 'page' => null])) ?>" <?php if ($dataProvider->pagination->pageSize == $value): ?>selected="selected"<?php endif; ?>><?= $value ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'title',
            'preview' => [
                'format' => 'image',
                'value' => function($data) {
                    return $data->preview;
                },
            ],
            'url',
             // 'shortdesc:ntext',
            'quest_item',
            'date_create',
            'date_update',
            'creator',
            // 'trader_group',
            // 'content:ntext',
            // 'active',
            
// Ниже узнаем по связи название родительской категории из связанной таблицы
//            [
//                'attribute' => 'parentcat_id',
//                'value' => 'parentcat.title',
//            ],

            [
                'attribute' => 'parentcat_id',
                'value' => 'parentcat.title',
                'filter' => Html::activeDropDownList($searchModel,'parentcat_id',ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'title'), ['class'=>'form-control','prompt'=>'Выберите родительскую категорию предмета']),
            ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
            'class' => 'table table-striped table-bordered customed'
        ],
    ]); ?>
</div>
