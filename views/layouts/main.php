<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\components\MenuComponent;
use app\assets\AppAsset;
use martyn911\adblock\detector\Detector;
use app\models\Sessions;
use yii\web\session;
use yii\web\Cookie;

$cookies = Yii::$app->request->cookies;
$addcook = Yii::$app->response->cookies;
// $session = Yii::$app->session;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-5071904663034434",
            enable_page_level_ads: true
        });
    </script>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="https://tarkov-wiki.ru/favicon.png">
    <meta name="yandex-verification" content="43485f66dfa368e2" />
    <?php if(stristr(Yii::$app->request->url,'/keys/')) { 
    } else if(stristr(Yii::$app->request->url,'/news/')) { 
    } else if(stristr(Yii::$app->request->url,'/articles/')){
    } else {?>
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="База знаний Escape from Tarkov">
        <meta property="og:title" content="<?= Html::encode($this->title) ?>">
        <meta property="og:image" content="/img/logo-full.png">
    <?php } ?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- BEGIN JIVOSITE CODE {literal} -->
    <script type='text/javascript'>
        (function(){ var widget_id = 'OXowZeYTop';var d=document;var w=window;function l(){
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
    <!-- {/literal} END JIVOSITE CODE -->

    <meta name="442ee7acba0cd76db400fc3fe05d5327" content="">
</head>

<body>
<?php $this->beginBody() ?>

<?= Detector::widget([
    'timeout' => 200, //Число миллисекунд, в конце которых считается, что AdBlock не включен
    'callback_detected' => 'CheckingUser', //js функция, которая выполняется если adblock включен
    'callback_not_detected' => false, //js функция, которая выполняется если adblock не включен. Можно отключить - false
]); ?>

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
                        <a href="https://discord.gg/n738Xy2" target="_blank"><img alt="V-Power сервер Discord" src="/img/soc/discord-soc.jpg"></a>
                        <a href="https://vk.com/vector_power" target="_blank"><img alt="V-Power сообщество Вконтакте" src="/img/soc/vk-user.jpg"></a>
                        <a href="https://vector-power.ru" target="_blank"><img alt="V-Power официальный сайт сообщества" src="/img/soc/v-power-edited.jpg"></a>
                    </div>

                    <p class="contact-info">Контактный Email: <a href="mailto:info@tarkov-wiki.ru">info@tarkov-wiki.ru</a></p>

                </div>
              <span class="col-sm-12 counter-footer"></span>
            </div>
        </div>
</footer>

<span class="visible-md visible-lg"><a href="#" class="scup"><i class="fa fa-angle-up active"></i></a></span>

<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter47100633 = new Ya.Metrika({ id:47100633, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/47100633" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


<script type="text/javascript" src="/js/core-checker.js"></script>

<script type="text/javascript">
    var adblock = true;
</script>

<script type="text/javascript" src="/js/adframe.js"></script>
<script type="text/javascript">
    if(adblock) {
        var adsl =  $('html>div>div>div>h2.uni-fate').text();
        if(adsl !== 'Вы используете блокировщик рекламы') {
            CheckingUser();
        }
    }
</script>
<script type="text/javascript">
    (function(){
        var bait = 'http://googleads.g.doubleclick.net/pagead/gen_204?id=wfocus&gqid=advertisment&advert=ads';
        $.ajax({url: bait, dataType: "script"})
            .fail(function () {  })
            .abort(function () { CheckingUser(); });
    })();
</script>

<?php

/*** Устанавливаем кукис - чтобы попап больше не всплывал ***/
//if(!isset($cookies['gifts-23092018']) && !stristr(Yii::$app->request->url,'/loot') && !stristr(Yii::$app->request->url,'/skills')): {
//    $addcook->add(new Cookie([
//        'name' => 'gifts-23092018',
//        'value' => 1,
//        'expire' => time() + (10 * 365 * 24 * 60 * 60),
//        'secure' => true,
//    ]));
//}
// endif;
?>


