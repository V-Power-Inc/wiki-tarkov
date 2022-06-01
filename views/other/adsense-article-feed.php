<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.12.2018
 * Time: 20:51
 */

/*** Это вьюха рекламного блока для статьи - используется на странице валют ***/

?>

<?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles' && Yii::$app->request->url !== '/loot/weapons/pistols' && !stristr(Yii::$app->request->url,'/loot/modules?page') && Yii::$app->request->url !== '/loot/modules/trunk' && Yii::$app->request->url !== '/loot/modules'): ?>
    <!-- empty ads place -->
<?php endif; ?>
