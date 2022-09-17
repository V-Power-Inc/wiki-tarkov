<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eger */

$this->title = 'Create Eger';
$this->params['breadcrumbs'][] = ['label' => 'Egers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eger-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
