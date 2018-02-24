<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Skills */

$this->title = 'Create Skills';
$this->params['breadcrumbs'][] = ['label' => 'Skills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
