<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 01.06.2022
 * Time: 23:42
 * Виджет комментариев
 */
?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <script type="text/javascript">
        VK.init({
            apiId: 8182969,
            onlyWidgets: true
        });
    </script>

    <div id="vk_comments"></div>
    <script type="text/javascript">
        VK.Widgets.Comments('vk_comments');
    </script>

</div>