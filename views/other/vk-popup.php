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

<div class="vk-gifts-take">
    <div class="rl-pos">
        <img class="mx-100 close-vote" src="/img/cancel-vote.png" onclick="yaCounter47100633.reachGoal('frm-close'); return true;">
    </div>
    
    <p class="title-block-gifts">Розыгрыш игровых ключей</p>

    <div class="games-gifts">
        <img src="/img/games-gifts.png">
    </div>

    <p class="block-gifts-desc">От лица администрации сайта tarkov-wiki.ru и игрового сообщества V-Power проводится розыгрыш с раздачей ключей от <b>Escape From Tarkov: Edge of Darkness, Metro: Exodus, Scum</b> и других интересных проектов.</p>

    <!-- todo: Сделать ссылку именно на конкурсный пост -->
    <p class="link-to-vk"><a href="https://vk.com/vector_power" target="_blank">Подробнее в нашей группе Вконтакте</a></p>

    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>

    <div class="col-lg-12">
        <!-- VK Widget -->
        <div id="widget_pop"></div>
        <script type="text/javascript">
            VK.Widgets.Group("widget_pop", {mode: 3, width: "470", height: "300"}, 162698237);
        </script>
    </div>

</div>
