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
            Items::ATTR_TITLE,
            Items::ATTR_PREVIEW => [
                'attribute' => Items::ATTR_PREVIEW,
                'format' => 'image',
                'value' => function($data) {
                    return $data->preview;
                },
            ],

            Items::ATTR_URL => [
                'attribute' => Items::ATTR_URL,
                'format' => 'raw',
                'value' => function($url) {
                    return $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . '/loot/<b>'.$url->url.'</b>.html';
                },
            ],
            Items::ATTR_DATE_CREATE,
            Items::ATTR_DATE_UPDATE,
            Items::ATTR_CREATOR => [
                'attribute' => Items::ATTR_CREATOR,
                'format' => 'html',
                'value' => function($user) {
                    if(!is_null($user->creator)) {
                    return '<span class="fa fa-user adm-blue"></span> '.$user->creator ;
                    } else {
                        return '<span class="not-set">Не определен</span>';
                    }
                },
                'filter' => Html::activeDropDownList($searchModel,Items::ATTR_CREATOR,ArrayHelper::map(Items::find()->where(['is not',Items::ATTR_CREATOR,null])->groupBy([Items::ATTR_CREATOR])->asArray()->all(), Items::ATTR_CREATOR, Items::ATTR_CREATOR), ['class'=>'form-control','prompt'=>'Выберите создателя']),
            ],
            
            /** Ниже узнаем по связи название родительской категории из связанной таблицы */
            [
                'attribute' => Items::ATTR_PARENTCAT_ID,
                'value' =>  Items::RELATION_PARENTCAT . '.' . Items::ATTR_TITLE,
                'filter' => Html::activeDropDownList($searchModel,Items::ATTR_PARENTCAT_ID,ArrayHelper::map(Category::find()->asArray()->all(), Items::ATTR_ID, Items::ATTR_TITLE), ['class'=>'form-control','prompt'=>'Выберите родительскую категорию предмета']),
            ],
            [
                'attribute' => 'active',
                'format' => 'raw',
                'value' => function($active) {
                    if($active->active === Items::TRUE) {
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
