<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 21.04.2018
 * Time: 7:59
 * View of Google adsense - used as compact short link in main views with render
 */
?>

    <div class="no-adb">
        <a href="https://kiberlot.ru/lots/games/63?uuid=1358b89d-7f88-4442-a398-0f0bbe6b49c8" onclick="yaCounter47100633.reachGoal('kbr-lot-2'); return true;" target="_blank">
            <img class="mx-100" src="/img/kiberlot.png">
        </a>
    </div>

    <div class="no-adb">
        <a href="https://v-power.myprintbar.ru/tovari/?reffer=tarkovwiki&heshtag=stalker&search=yes"  onclick="yaCounter47100633.reachGoal('banner_v_link'); return true;" target="_blank">
            <img class="mx-100" src="/img/stalker-banner.jpg">
        </a>
    </div>

<?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles' && Yii::$app->request->url !== '/loot/weapons/pistols' && Yii::$app->request->url !== '/loot/modules/pistol-grip' && !stristr(Yii::$app->request->url,'/loot/modules?page') && Yii::$app->request->url !== '/loot/modules/trunk'): ?>

<div class="no-adb">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-5071904663034434"
         data-ad-slot="1963713047"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>

<div class="no-adb fortunite-block">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-5071904663034434"
         data-ad-slot="1963713047"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

</div>

<?php endif; ?>