<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 21.04.2018
 * Time: 7:59
 * View of Google adsense gorizontal blocks - used as compact short link in main views with render
 */
?>

<?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html'): ?>

<div class="no-adb">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-9672363886013669"
         data-ad-slot="1163371926"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>

<?php endif; ?>