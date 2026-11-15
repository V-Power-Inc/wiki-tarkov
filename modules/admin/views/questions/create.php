<?php

use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var app\models\Questions $model */

$this->title = 'Создание нового вопроса и ответа';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
