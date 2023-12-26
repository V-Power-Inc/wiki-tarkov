<?php
use app\models\Category;
use yii\helpers\Url;

/** @var Category $category - AR объект категории справочника лута */
?>

<!-- 1 level -->
<?php if(!isset($category['childs'])) : ?>
    <li class="relative <?= (stristr(Yii::$app->request->url, Url::to(['/loot/' . $category[Category::ATTR_URL]  ]))) ? 'active' : '' ?>"><a href="<?= Url::to(['/loot/'.$category[Category::ATTR_URL]  ]); ?>"><?= $category[Category::ATTR_TITLE] ?></a>
<?php endif; ?>

<!-- 2 level -->
<?php if(isset($category['childs'])) : ?>
    <li class="relative  <?= (stristr(Yii::$app->request->url, Url::to(['/loot/' . $category[Category::ATTR_URL]  ]))) ? 'active' : '' ?>"><a href="<?= Url::to(['/loot/'.$category[Category::ATTR_URL]  ]); ?>"><?= $category[Category::ATTR_TITLE] ?></a>
    <div class="dcjq-icon">&nbsp;&nbsp;&nbsp;</div>
    <ul class="children-cats">
        <?php foreach($category['childs'] as $childCategory) : ?>
            <li class="level-2 <?= (stristr(Yii::$app->request->url, Url::to(['/loot/' . $category[Category::ATTR_URL]. '/' .$childCategory[Category::ATTR_URL]]))) ? 'active' : '' ?>"><i class="fa fa-check-circle" aria-hidden="true"></i><a href="<?= Url::to(['/loot/'.$category[Category::ATTR_URL]. '/' .$childCategory[Category::ATTR_URL]]); ?>"><?= $childCategory[Category::ATTR_TITLE] ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>