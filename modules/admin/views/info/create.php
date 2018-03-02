<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Info */

$this->title = 'Создание нового виджета';
$this->params['breadcrumbs'][] = ['label' => 'Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
