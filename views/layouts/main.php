<?php

/* @var $this View */
/* @var $content string */

use yii\web\View;
use yii\helpers\Html;
use app\components\MenuComponent;
use app\assets\AppAsset;
use app\components\CookieComponent;
use app\common\interfaces\ResponseStatusInterface;

$cookies = Yii::$app->request->cookies;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=$_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN']?>/favicon.png" type="image/png">
    <meta name="yandex-verification" content="114a7ff38e4fe597" />
    <meta name="verification" content="2899618770bb593c65f207fbe992fc" />

    <!-- Yandex.RTB -->
    <script>window.yaContextCb = window.yaContextCb || []</script>
    <script src="https://yandex.ru/ads/system/context.js" async></script>

    <!-- OG tags -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="База знаний Escape from Tarkov">
    <meta property="og:title" content="<?= Html::encode($this->title) ?>">
    <meta property="og:image" content="/img/logo-full.png">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Check styles, which enabled by user -->
    <?php if (isset($cookies[CookieComponent::NAME_DARK_THEME])): ?>
        <link id="dark_theme" href="/css/dark-theme.css?v=6.8.12" rel="stylesheet">
    <?php endif; ?>

    <!-- Вынесено сюда из за возможностей менять цветовую тему -->
    <link href="/css/media-queryes.css?v=6.8.12" rel="stylesheet">

</head>

<body>
<?php $this->beginBody() ?>


<div class="wrap">
    <!-- Заглушка фиксированного меню -->
    <div class="h-52"></div>

        <!-- Горизонатльное меню - вызываемое компонентом -->
        <?= MenuComponent::showMenu(); ?>

        <!-- Заголовки определенных страниц -->
        <?php if (!in_array(Yii::$app->request->url,Yii::$app->params['restrictedAlertsUrls']) &&
            Yii::$app->response->statusCode === ResponseStatusInterface::OK_CODE): ?>

            <div class="heading-class">
                <div class="container">
                    <h1 class="main-site-heading"><?= $this->title; ?></h1>
                </div>
            </div>

            <hr class="grey-line">

        <?php endif; ?>

        <?= $content ?>
</div>

<footer>
    <div class="container nobackground">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <p class="marks">Все права на Escape from Tarkov принадлежат Battlestate Games Limited <br> <a href="https://www.escapefromtarkov.com">Официальный сайт разработчиков</a></p>

                <p class="github-repo marks">Проект wiki-tarkov имеет открытый исходный код. Код доступен на <a href="https://github.com/V-Power-Inc/wiki-tarkov" target="_blank" onclick="ym(47100633,'reachGoal','github_link')"><b>GitHub</b></a></p>
            </div>

            <div class="col-lg-4 col-lg-offset-3 col-md-offset-3 col-md-4 col-sm-12 col-xs-12">
                <p class="copyright text-center">© 2017-<?= date("Y") ?>&nbsp;<span class="organization_footer_title">V-Power</span></p>

                <div class="icons-soc">
                    <a href="https://discord.gg/K4R239u" target="_blank"><img alt="V-Power сервер Discord" src="/img/soc/discord-soc.jpg"></a>
                    <a href="https://vk.com/vector_power" target="_blank"><img alt="V-Power сообщество Вконтакте" src="/img/soc/vk-user.jpg"></a>
                    <a href="https://github.com/V-Power-Inc/wiki-tarkov" target="_blank" onclick="ym(47100633,'reachGoal','github_link')"><img alt="GitHub репозиторий" src="/img/soc/github.png"></a>
                </div>

                <p class="contact-info">Контактный Email: <a href="mailto:tarkov-wiki@ya.ru">tarkov-wiki@ya.ru</a></p>

            </div>
        </div>
    </div>
</footer>

<?= $this->render('/other/yandex-direct-mobile-fullscreen')?>

<?php if (!isset($cookies['overlay'])): ?>
    <div class="overlay-block">
        <div class="cls-btn" id="cck_close">Закрыть</div>
        <?= $this->render('/other/yandex-direct-overlay') ?>
    </div>
<?php else: ?>
    <script type="text/javascript">
        (function(d, t) {
            var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
            v.onload = function() {
                window.voiceflow.chat.load({
                    verify: { projectID: '676becf3ad9feb7cbcc1042a' },
                    url: 'https://general-runtime.voiceflow.com',
                    versionID: 'production',
                    voice: {
                        url: "https://runtime-api.voiceflow.com"
                    }
                });
            }
            v.src = "https://cdn.voiceflow.com/widget-next/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
        })(document, 'script');
    </script>
<?php endif; ?>

<span class="visible-md visible-lg"><a href="#" class="scup"><i class="fa fa-angle-up active"></i></a></span>

<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(47100633, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/47100633" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>