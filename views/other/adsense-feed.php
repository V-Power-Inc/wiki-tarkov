<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.12.2018
 * Time: 15:29
 */

/** Это вьюха новостей в фиде - для страниц с большими списками категорий **/

?>


<?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles' && Yii::$app->request->url !== '/loot/weapons/pistols' && Yii::$app->request->url !== '/loot/modules/pistol-grip' && !stristr(Yii::$app->request->url,'/loot/modules?page') && Yii::$app->request->url !== '/loot/modules/trunk' && Yii::$app->request->url !== '/loot/modules'): ?>
    <!-- empty ads place -->
<?php endif; ?>