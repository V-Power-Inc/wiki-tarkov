<!-- 1 уровень вложенности -->
<?php if(!isset($category['childs'])) : ?>
<li class="relative <?= (ltrim(strrchr(Yii::$app->request->url,'/'),'/') == $category['url']) ? 'active' : '' ?>"><a href="/loot/<?= $category['url'] ?>"><?= $category['title'] ?></a>
<?php endif; ?>

<!-- 2 уровень вложенности -->    
<?php if(isset($category['childs'])) : ?>
    <li class="relative  <?= (stristr(Yii::$app->request->url, $category['url'])) ? 'active' : '' ?>"><a href="/loot/<?= $category['url'] ?>"><?= $category['title'] ?></a>
    <div class="dcjq-icon">&nbsp;&nbsp;&nbsp;</div>
    <ul class="children-cats">
        <?php foreach($category['childs'] as $childCategory) : ?>
        <li class="level-2 <?= (ltrim(strrchr(Yii::$app->request->url,'/'),'/') == $childCategory['url']) ? 'active' : '' ?>"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="/loot/<?= $category['url'] ?>/<?= $childCategory['url'] ?>"><?= $childCategory['title'] ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>



