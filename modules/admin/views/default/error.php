<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

/** Сетапим title в соответствии с именем ошибки */
$this->title = $name;

/** Вьюха для отображения ошибок для посетителей сайта */
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="site-error">

                <h1><?= Html::encode($this->title) ?></h1>

                <div class="alert alert-danger">
                    <?= nl2br(Html::encode($message)) ?>
                </div>

                <button class="btn btn-primary"><a href="/admin" style="color: white; text-decoration: none;">Вернуться на главную</a></button>

            </div>
        </div>
    </div>
</div>

