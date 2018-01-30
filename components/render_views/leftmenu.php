<!-- 1 уровень вложенности -->
<?php if(!isset($category['childs'])) : ?>
<li class="relative <?= (ltrim(strrchr(Yii::$app->request->url,'/'),'/') == $category['id']) ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['loot/category', 'id' => $category['id']]); ?>"><?= $category['title'] ?></a>
<?php endif; ?>

<!-- 2 уровень вложенности -->    
<?php if(isset($category['childs'])) : ?>
    <li class="relative  <?= (stristr(Yii::$app->request->url, $category['id'])) ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['loot/category', 'id' => $category['id']]); ?>"><?= $category['title'] ?></a>
    <div class="dcjq-icon">&nbsp;&nbsp;&nbsp;</div>
    <ul class="children-cats">
        <?php foreach($category['childs'] as $childCategory) : ?>
        <li class="level-2 <?= (ltrim(strrchr(Yii::$app->request->url,'/'),'/') == $childCategory['url']) ? 'active' : '' ?>"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="<?= \yii\helpers\Url::to(['loot/category', 'id' => $childCategory['id']]); ?>"><?= $childCategory['title'] ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>



