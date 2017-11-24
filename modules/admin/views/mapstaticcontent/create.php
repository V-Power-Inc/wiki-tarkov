<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mapstaticcontent */

$this->title = 'Create Mapstaticcontent';
$this->params['breadcrumbs'][] = ['label' => 'Mapstaticcontents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapstaticcontent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
