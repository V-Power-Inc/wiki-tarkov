<!-- 1 level -->
<?php if(!isset($category['childs'])) : ?>
<li class="relative <?= (stristr(Yii::$app->request->url, \yii\helpers\Url::to(['/loot/'.$category['url']  ]))) ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['/loot/'.$category['url']  ]); ?>"><?= $category['title'] ?></a>
<?php endif; ?>

<!-- 2 level -->
<?php if(isset($category['childs'])) : ?>
    <li class="relative  <?= (stristr(Yii::$app->request->url, \yii\helpers\Url::to(['/loot/'.$category['url']  ]))) ? 'active' : '' ?>"><a href="<?= \yii\helpers\Url::to(['/loot/'.$category['url']  ]); ?>"><?= $category['title'] ?></a>
    <div class="dcjq-icon">&nbsp;&nbsp;&nbsp;</div>
    <ul class="children-cats">
        <?php foreach($category['childs'] as $childCategory) : ?>
        <li class="level-2 <?= (stristr(Yii::$app->request->url, \yii\helpers\Url::to(['/loot/'.$category['url']. '/' .$childCategory['url']]))) ? 'active' : '' ?>"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="<?= \yii\helpers\Url::to(['/loot/'.$category['url']. '/' .$childCategory['url']]); ?>"><?= $childCategory['title'] ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>



