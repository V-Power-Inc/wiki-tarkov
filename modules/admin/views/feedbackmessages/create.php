<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FeedbackMessages */

$this->title = 'Create Feedback Messages';
$this->params['breadcrumbs'][] = ['label' => 'Feedback Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
