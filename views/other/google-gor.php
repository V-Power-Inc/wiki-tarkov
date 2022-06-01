<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 21.04.2018
 * Time: 7:59
 * View of Google adsense gorizontal blocks - used as compact short link in main views with render
 */
?>

<?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles' && Yii::$app->request->url !== '/loot/weapons/pistols' && Yii::$app->request->url !== '/loot/modules/pistol-grip' && !stristr(Yii::$app->request->url,'/loot/modules?page') && Yii::$app->request->url !== '/loot/modules/trunk' && Yii::$app->request->url !== '/loot/modules'): ?>

<!-- empty ads place -->

<?php endif; ?>