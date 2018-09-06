<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 05.09.2018
 * Time: 20:17
 */

/*** Вьюха виджета вконтакте сообщества V-Power ***/
?>

<script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>

<!-- VK Widget -->
<div id="vk_groups" style="margin-bottom: 10px; height: 300px;"></div>
<script type="text/javascript">
    VK.Widgets.Group("vk_groups", {mode: 3, width: "262", height: "300"}, 162698237);
</script>
