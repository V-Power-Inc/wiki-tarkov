<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\components\MenuComponent;
use app\assets\AppAsset;

$cookies = Yii::$app->request->cookies;
$addcook = Yii::$app->response->cookies;

// Получаем статус ответа сервера
$status_response = Yii::$app->response->getStatusCode();

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://wiki-tarkov.ru/favicon.png" type="image/png">
    <meta name="yandex-verification" content="114a7ff38e4fe597" />
    <meta name="verification" content="2899618770bb593c65f207fbe992fc" />

    <!-- Banner frames -->
    <script type='text/javascript'>
        rbConfig={start:performance.now(),rbDomain:'rotarb.bid',rotator:'rtpn'};token=localStorage.getItem('rtpn')||(1e6+'').replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16));rsdfhse=document.createElement('script');
        rsdfhse.setAttribute('src','//rotarb.bid/rtpn.min.js?'+token);rsdfhse.setAttribute('async','async');rsdfhse.setAttribute('type','text/javascript');document.head.appendChild(rsdfhse);
        localStorage.setItem('rtpn', token);</script>

    <!-- Yandex.RTB -->
    <script>window.yaContextCb=window.yaContextCb||[]</script>
    <script src="https://yandex.ru/ads/system/context.js" async></script>

    <!-- OG tags -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="База знаний Escape from Tarkov">
    <meta property="og:title" content="<?= Html::encode($this->title) ?>">
    <meta property="og:image" content="/img/logo-full.png">

    <script src="https://vk.com/js/api/openapi.js?169" type="text/javascript"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>


<div class="wrap">
    <!-- Заглушка фиксированного меню -->
    <div class="h-52"></div>
    
    <!-- Горизонатльное меню - вызываемое компонентом -->
    <?= MenuComponent::showMenu() ?>
    
    <?= $content ?>
</div>

<footer>
    
        <div class="container nobackground">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <p class="marks">Все права на Escape from Tarkov принадлежат Battlestate Games Limited <br> <a href="https://www.escapefromtarkov.com">Официальный сайт разработчиков</a></p>
                </div>

                <div class="col-lg-4 col-lg-offset-3 col-md-offset-3 col-md-4 col-sm-12 col-xs-12">
                    <p class="copyright text-center">© 2017-<?php echo date("Y");?>&nbsp;<a>V-Power</a></p>

                    <div class="icons-soc">
                        <a href="https://discord.gg/K4R239u" target="_blank"><img alt="V-Power сервер Discord" src="/img/soc/discord-soc.jpg"></a>
                        <a href="https://vk.com/vector_power" target="_blank"><img alt="V-Power сообщество Вконтакте" src="/img/soc/vk-user.jpg"></a>
<!--                        <a href="###" target="_blank"><img alt="V-Power официальный сайт сообщества" src="/img/soc/v-power-edited.jpg"></a>-->
                    </div>

                    <p class="contact-info">Контактный Email: <a href="mailto:tarkov-wiki@ya.ru">tarkov-wiki@ya.ru</a></p>

                </div>
              <span class="col-sm-12 counter-footer"></span>
            </div>
        </div>
</footer>

<span class="visible-md visible-lg"><a href="#" class="scup"><i class="fa fa-angle-up active"></i></a></span>

<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(47100633, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/47100633" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



