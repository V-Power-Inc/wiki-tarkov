<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var app\models\Catskills $model */

$this->title = 'Создать новую категорию скила';
$this->params['breadcrumbs'][] = ['label' => 'Catskills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catskills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
