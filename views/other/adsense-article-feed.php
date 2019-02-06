<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.12.2018
 * Time: 20:51
 */

/*** Это вьюха рекламного блока для статьи - используется на странице валют ***/

?>

<?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles' && Yii::$app->request->url !== '/loot/weapons/pistols' && !stristr(Yii::$app->request->url,'/loot/modules?page') && Yii::$app->request->url !== '/loot/modules/trunk'): ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-5071904663034434"
     data-ad-slot="9226765946"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php endif; ?>
