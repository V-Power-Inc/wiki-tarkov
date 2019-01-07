<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 21.04.2018
 * Time: 7:59
 * View of Google adsense gorizontal blocks - used as compact short link in main views with render
 */
?>

<?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles' && Yii::$app->request->url !== '/loot/weapons/pistols' && !stristr(Yii::$app->request->url,'/loot/modules?page')): ?>

<div class="no-adb">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-5071904663034434"
         data-ad-slot="7149710678"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    
</div>

<?php endif; ?>