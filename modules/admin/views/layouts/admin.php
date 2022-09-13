<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 24.10.2017
 * Time: 14:26
 *
 * Админский layout сайта
 */

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AdminAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\common\controllers\AdminController;
use app\controllers\SiteController;
use app\controllers\TraderController;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="https://wiki-tarkov.ru/favicon.png">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'Админка сайта - wiki-tarkov',
            'brandUrl' => '/admin',
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        if (Yii::$app->user->isGuest) {
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Авторизация', 'url' => [AdminController::LOGIN_URL]]
                ],
            ]);
            NavBar::end();
            
    } elseif(!Yii::$app->user->isGuest) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Открыть сайт', 'url' => [SiteController::getUrlRoute(SiteController::ACTION_INDEX)], 'linkOptions' => ['target' => '_blank', 'style'=>'width: 170px;']],
                ['label' => 'Справочник квестов', 'url' => [TraderController::getUrlRoute(TraderController::ACTION_QUESTS)], 'linkOptions' => ['target' => '_blank', 'style'=>'width: 170px;']],
                ['label' => 'База ключей', 'url' => [SiteController::getUrlRoute(SiteController::ACTION_KEYS)] , 'linkOptions' => ['target' => '_blank', 'style'=>'width: 170px;']],
                ['label' => 'Список новостей', 'url' => [SiteController::getUrlRoute(SiteController::ACTION_NEWS)] , 'linkOptions' => ['target' => '_blank', 'style'=>'width: 170px;']],
                (
                    '<li>'
                    . Html::beginForm([AdminController::LOGOUT_URL], 'post')
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

        <div id="particles-js"></div>
        
        <div class="container padding-top-110">
           <?php if(Yii::$app->request->url == '/admin'): ?>
                <?php if(isset(Yii::$app->user->identity->user)): ?>
                <!-- Блок данных об авторизованном пользователе -->
                <!-- Добавили блок Display-none - функционал временно отключен за ненужностью -->
                <div style="display: none;">
                    <div class="row">
                        <div class="col-lg-12 auth-info relative">
                            <div class="exit"><img class="exits-icon-admin" alt="Close-icon" src="/img/exits-krest.png"></div>
                            <p class="text-center auth-title">Учетные данные авторизованного пользователя</p>
                            <p class="auth-info">Логин: <span><?= Yii::$app->user->identity->user ?></span></p>
                            <p class="auth-info">Имя: <span><?= Yii::$app->user->identity->name ?></span></p>
                            <p class="auth-info">Роль: <span style="color:red;"><?= Yii::$app->user->identity->role ?></span></p>
                            <p class="auth-info">Дата окончания учетной записи: <span><?= (Yii::$app->user->identity->date_end)?Yii::$app->user->identity->date_end:'Учетная запись не лимитирована датой окончания'?></span></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
           <?php endif; ?>

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
                    <p class="copyright text-right">© 2017-<?php echo date("Y");?>&nbsp;<a>V-Power</a></p>
                </div>
                <span class="col-sm-12 counter-footer"></span>
            </div>
        </div>
    </footer>

    <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(47100633, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/47100633" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
    </body>
    <?php $this->endBody() ?>

    </html>
<?php $this->endPage() ?>