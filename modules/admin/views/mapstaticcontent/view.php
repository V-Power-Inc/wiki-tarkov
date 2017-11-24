<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mapstaticcontent */

$this->title = $model->markername;
$this->params['breadcrumbs'][] = ['label' => 'Mapstaticcontents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapstaticcontent-view">

    <h1>Обновить описание записи: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить описание', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-primary" href="/admin/mapstaticcontent/">Вернуться в список описаний</a>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
            'markername',
        ],
    ]) ?>

    
</div>
