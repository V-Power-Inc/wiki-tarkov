<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.10.2017
 * Time: 14:26
 */

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AdminAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://tarkov-wiki.ru/favicon.png">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'Админка сайта - tarkov-wiki',
            'brandUrl' => '/admin',
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        if (Yii::$app->user->isGuest) {
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Авторизация', 'url' => ['/site/login']]
                ],
            ]);
            NavBar::end();
            
    } elseif(!Yii::$app->user->isGuest) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Открыть сайт', 'url' => ['/site/index'], 'linkOptions' => ['target' => '_blank', 'style'=>'width: 170px;']],
                ['label' => 'Справочник квестов', 'url' => ['/site/quests'], 'linkOptions' => ['target' => '_blank', 'style'=>'width: 170px;']],
                ['label' => 'База ключей', 'url' => ['/site/keys'] , 'linkOptions' => ['target' => '_blank', 'style'=>'width: 170px;']],
                ['label' => 'Список новостей', 'url' => ['/site/news'] , 'linkOptions' => ['target' => '_blank', 'style'=>'width: 170px;']],
                Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
                ) : 
                    (
                    '<li>'
                    . Html::beginForm(['default/logout'], 'post')
                    . Html::submitButton(
                        'Выход (' . Yii::$app->user->identity->user . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
    }
        ?>
        <div class="container padding-top-110">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <?= $content ?>
                </div>
            </div>
        </div>
    </div>

    <footer>

        <div class="container nobackground">
            <div class="row">
                <div class="col-sm-12">
                    <p class="copyright text-right">© 2017-<?php echo date("Y");?>&nbsp;<a href="https://kfc-it.ru" target="_blank">KFCTP Internet Community</a></p>
                </div>
<span class="col-sm-12 counter-footer">
</span>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>