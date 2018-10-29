<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 21.04.2018
 * Time: 7:59
 * View of Google adsense - used as compact short link in main views with render
 */
?>


<?php if(Yii::$app->request->url !== '/loot/modules/sight' && Yii::$app->request->url !== '/loot/telescopic-sight-hamr-deltapoint.html' && Yii::$app->request->url !== '/loot/weapons/rifles'): ?>

<div class="no-adb">
    <!-- Payment -->
    <a href="https://kiberlot.ru/lots/games/63?uuid=304ab6d5-4721-485c-8127-705b44a2fd88" onclick="yaCounter47100633.reachGoal('kiber-lot'); return true;" target="_blank">
        <img class="mx-100" src="/img/kiberlot.png">
    </a>
</div>

<div class="no-adb">
    <!-- vertical blocks - disabled since 29-10-2018 -->
</div>

<?php endif; ?>