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

        <div id="particles-js"></div>
        
        <div class="container padding-top-110">

            <div class="row">
                <div class="col-lg-12 auth-info">
                    <p class="text-center auth-title">Учетные данные авторизованного пользователя</p>
                    <p class="auth-info">Логин: <span><?= Yii::$app->user->identity->user ?></span></p>
                    <p class="auth-info">Имя: <span><?= Yii::$app->user->identity->name ?></span></p>
                    <p class="auth-info">Роль: <span style="color:red;"><?= Yii::$app->user->identity->role ?></span></p>
                    <p class="auth-info">Дата окончания учетной записи: <span><?= (Yii::$app->user->identity->date_end)?Yii::$app->user->identity->date_end:'Учетная запись не лимитирована датой окончания'?></span></p>
                </div>
            </div>


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
<span class="col-sm-12 counter-footer">
</span>
            </div>
        </div>
    </footer>

    <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter47100633 = new Ya.Metrika({ id:47100633, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/47100633" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
    
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>