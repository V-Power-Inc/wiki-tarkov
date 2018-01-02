<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mirotvorec */

$this->title = 'Create Mirotvorec';
$this->params['breadcrumbs'][] = ['label' => 'Mirotvorecs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mirotvorec-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
