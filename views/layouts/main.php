<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="https://eft-locations.kfc-it.ru/favicon.png">
    <meta name="yandex-verification" content="2ef7e287e1b8f79d" />
    <meta property="og:title" content="База знаний Escape from Tarkov">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="База знаний Escape from Tarkov">
    <meta property="og:description" content="Интерактивные карты локаций, описания квестов торговцев и их прохождения, карта ключей от помещений">
    <meta property="og:url" content="https://eft-locations.kfc-it.ru">
    <meta property="og:image" content="/img/logo-full.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">


    <!-- Заглушка фиксированного меню -->
    <div class="h-52"></div>

    <!-- Классы navbar и navbar-default (базовые классы меню) -->
    <nav class="navbar navbar-default fixed-navigatsiya">
        <div class="container">
            <!-- Заголовок -->
            <div class="navbar-header">
                <a class="mobile-brand" href="/">База знаний Escape from Tarkov</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Основная часть меню (может содержать ссылки, формы и другие элементы) -->
            <div class="collapse navbar-collapse" id="navbar-main">
                <!-- Содержимое основной части -->
                <a class="navbar-brand relative" href="https://eft-locations.kfc-it.ru"><img class="logo-img" src="/img/logo-full.png" alt="Логотип eft-locations.kfc-it.ru"></a>

                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Главная</a></li>
                    <li><a href="/quests-of-traders">Справочник квестов</a></li>
                    <li><a href="#">Карты локаций</a></li>
                    <li><a href="#">YouTube материалы</a></li>
                </ul>

            </div>
        </div>
    </nav>


        <?= $content ?>

    
    
</div>

<footer>
    
        <div class="container nobackground">
            <div class="row">
                <div class="col-sm-9">
<!--                    <div class="footerbottomlink">-->
<!--                        <a href="#">Линк 1</a>-->
<!--                        <a href="#">Линк 2</a>-->
<!--                        <a href="#">Линк 3</a>-->
<!--                        <a href="#">Линк 4</a>-->
<!--                        <a href="#">Линк 5</a>-->
<!--                        <a href="#">Линк 6</a>	-->
<!--                    </div>-->
                    <p class="copyright">© 2017 <a href="https://kfc-it.ru" target="_blank">KFCTP Internet Community</a></p>
                </div>
<span class="col-sm-12 counter-footer">
</span>
            </div>
        </div>
</footer>

<span class="visible-md visible-lg"><a href="#" class="scup"><i class="fa fa-angle-up active"></i></a></span>

<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter46368135 = new Ya.Metrika({ id:46368135, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/46368135" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
