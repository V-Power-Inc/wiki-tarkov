<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bereg */

$this->title = 'Создать новый маркер для интерактивной карты Берега';
$this->params['breadcrumbs'][] = ['label' => 'Beregs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bereg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
