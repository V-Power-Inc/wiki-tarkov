<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Category;
use yii\helpers\ArrayHelper;
use app\models\Items;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список предметов справочника лута';
$this->params['breadcrumbs'][] = $this->title;

/*** Массив значений справочника лута для вывода разного количества записей ***/
$values = [10,15, 25, 50, 75, 100, 150, 200, 250, 500];

/** Даем возможность на этой странице изменять количество отображаемых предметов справочника лута */
if(isset($_GET['per-page']) && is_numeric($_GET['per-page'])) {
    $dataProvider->pagination->pageSize=$_GET['per-page'];
} else {
    $dataProvider->pagination->pageSize=10;
}
?>

<style>
    td:last-child {
        width: 140px;
        display: block;
        height: 150px;
    }
    span.glyphicon {
        padding-top: 55px;
        font-size: 18px;
    }
</style>


<div class="items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новый предмет', ['create'], ['class' => 'btn btn-success']) ?>
        <a class="btn btn-primary" href="/admin/">Вернуться на главную в админку</a>
    </p>

    <div class="margins-vertical-20 custom-items-list-search">
        <label>Выберите количество записей для отображения:</label>

        <!-- Даем возможность на этой странице менять количество отображаемых предметов из справочника лута -->
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
                'attribute' => 'preview',
                'format' => 'image',
                'value' => function($data) {
                    return $data->preview;
                },
            ],

            'url' => [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function($url) {
                    return $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . '/loot/<b>'.$url->url.'</b>.html';
                },
            ],
            // 'shortdesc:ntext',
            // 'quest_item',
            'date_create',
            'date_update',
            'creator' => [
                'attribute' => 'creator',
                'format' => 'html',
                'value' => function($user) {
                    if(!is_null($user->creator)) {
                    return '<span class="fa fa-user adm-blue"></span> '.$user->creator ;
                    } else {
                        return '<span class="not-set">Не определен</span>';
                    }
                },
                'filter' => Html::activeDropDownList($searchModel,'creator',ArrayHelper::map(Items::find()->where(['is not','creator',null])->asArray()->all(), 'creator', 'creator'), ['class'=>'form-control','prompt'=>'Выберите создателя']),
            ],
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
            [
                'attribute' => 'active',
                'format' => 'raw',
                'value' => function($active) {
                    if($active->active === 1) {
                        return '<label class="label label-success customed-labels-adm">Активен</label>';
                    } else {
                        return '<label class="label label-danger customed-labels-adm">Отключен</label>';
                    }
                }
            ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' => [
            'class' => 'table table-striped table-bordered customed'
        ],
    ]); ?>
</div>
