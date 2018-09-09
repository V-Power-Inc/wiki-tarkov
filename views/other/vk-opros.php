<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 09.09.2018
 * Time: 22:03
 */

/*** Это виджет опроса вконтакте - когда происходят опросы, сюда помещается различный код ***/

?>

<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?159"></script>
<!-- Put this div tag to the place, where the Poll block will be -->
<div id="vk_poll"></div>
<script type="text/javascript">
    VK.Widgets.Poll("vk_poll", {}, "304168842_e63b2490b5e4397f4f");
</script>
