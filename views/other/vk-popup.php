<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 12.09.2018
 * Time: 13:20
 */

$this->registerJsFile('js/vk-core-votes.js', ['depends' => [\yii\web\JqueryAsset::class]]);

/*** Это виджет всплывающего окна с различным контентом - в данный момент тут опрос из группы вконтакте ***/

?>

<div class="vk-useridentity-vote">
    <div class="rl-pos">
        <img class="mx-100 close-vote" src="/img/cancel-vote.png">
    </div>
    
    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>
    <div id="vk_poll"></div>
    <script type="text/javascript">
        VK.Widgets.Poll("vk_poll", {}, "304168842_e63b2490b5e4397f4f");
    </script>
</div>
