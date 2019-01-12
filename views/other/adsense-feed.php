<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.12.2018
 * Time: 15:29
 */

/** Это вьюха новостей в фиде - для страниц с большими списками категорий **/

?>


<?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles' && Yii::$app->request->url !== '/loot/weapons/pistols' && Yii::$app->request->url !== '/loot/modules/pistol-grip' && !stristr(Yii::$app->request->url,'/loot/modules?page')): ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-format="fluid"
     data-ad-layout-key="-gc+s-j-i7+z8"
     data-ad-client="ca-pub-5071904663034434"
     data-ad-slot="1627246015"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php endif; ?>