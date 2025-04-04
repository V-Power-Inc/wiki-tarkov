<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 01.06.2022
 * Time: 23:42
 *
 * Виджет комментариев
 * UPD 10-01-2023 - Anycomments
 *
 * @link https://anycomment.io/
 */
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div id="anycomment-app"></div>
    <script>
        AnyComment = window.AnyComment || []; AnyComment.Comments = [];
        AnyComment.Comments.push({
            "root": "anycomment-app",
            "app_id": 4873,
            "language": "ru"
        })
        var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
        s.src = "https://widget.anycomment.io/comment/embed.js";
        var sa = document.getElementsByTagName("script")[0];
        sa.parentNode.insertBefore(s, s.nextSibling);
    </script>

</div>