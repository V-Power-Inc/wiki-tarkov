<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 07.03.2018
 * Time: 0:06
 */

use yii\web\JqueryAsset;
use app\models\Traders;
use app\components\LeftmenuWidget;
use yii\bootstrap\ActiveForm;
use app\models\Items;

/** @var Items $form_model - AR объект Items, форма в данном случае */

$this->title = 'Квестовые предметы Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Квестовые предметы в Escape from Tarkov енобьходимые для прохождения квестов торговцев а также поднятия репутации с торговцами.',
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Квестовы предметы в Таркове, квестовые предметы Escape from Tarkov',
]);

$this->registerJsFile('js/accordeon/vertical_menu.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/lootscripts/mainloot.js', ['depends' => [JqueryAsset::class]]);
$this->registerJsFile('js/fix-img-blocks.js', ['depends' => [JqueryAsset::class]]);
?>
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>
        
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <ul class="nav nav-pills nav-stacked categories categories-menu" id="categories-menu">
                <?= LeftmenuWidget::widget(['tpl' => 'leftmenu']) ?>
            </ul>

            <br>
            
            <p><a class="btn btn-default main-link" href="/loot/quest-loot" style="width: 100%;">Квестовые предметы</a></p>

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>
        </div>

        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 quests-content">

            <!-- Описание категории -->
            <p class="alert alert-info size-16">
                В этом разделе, вы сможете узнать все о квестовых предметах, которые необходимы для прохождения квестов торговцев в Escape from Tarkov.
            <br>
            <br>
                Для вашего удобства, предметы привязаны к каждому из торговцев, у которых они будут необходимы для прохождения квестов, чтобы найти интересующие вас квестомые предметы, вы можете воспользоваться поиском.
            </p>

            <div class="col-lg-12">

                <span class="key-selector">Искать квестовые предметы по торговцу:</span>
                <?php $form = ActiveForm::begin(['options' => ['action' => ['loot/questloot']],'id' => 'questloot','method' => 'post',]) ?>
                    <?= $form->field($form_model, 'questitem')->dropDownList(Traders::traderGroups(),
                        [
                            'value' => $formValue??'Все предметы'
                        ]);
                    ?>
                    <button type="submit" id="submitform" class="btn btn-primary h-37">Осуществить поиск...</button>
                <?php $form = ActiveForm::end() ?>

            </div>
            
        

            <?php if($form_model->load(Yii::$app->request->post())) : ?>
                <?php if(empty($questsearch)) : ?>
                    <!-- Нет лута -->
                    <div class="col-lg-12">
                        <p class="alert alert-danger size-16">Предметы соответствующие критериям не были найдены. Возможно, они еще на стадии заполнения.</p>
                    </div>
                    <!-- Нет лута -->
                <?php endif; ?>
                    <?php foreach ($questsearch as $item) : ?>
                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a href="/loot/<?= $item['url'] ?>.html"><?= $item['title'] ?></a></h2>
                                <a class="loot-link" href="/loot/<?= $item['url'] ?>.html">
                                    <div class="fixies-float-image">
                                        <img class="loot-image" alt="<?= $item['title'] ?>" src="<?= $item['preview'] ?>">
                                    </div>
                                </a>
                                <p class="loot-description"><?= $item['shortdesc'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
            <?php else : ?>
                    <?php foreach ($allquestitems as $item) : ?>
                        <div class="col-lg-12">
                            <div class="item-loot">
                                <h2 class="item-loot-title"><a href="/loot/<?= $item['url'] ?>.html"><?= $item['title'] ?></a></h2>
                                <a class="loot-link" href="/loot/<?= $item['url'] ?>.html"><img class="loot-image" alt="<?= $item['title'] ?>" src="<?= $item['preview'] ?>"></a>
                                <p class="loot-description"><?= $item['shortdesc'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
            <?php endif; ?>

            <div class="recommended-gm-content">
                <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Расстояние - заглушка -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 height-25"></div>

            <!-- Комментарии -->
            <?php if(empty($_GET)) : ?>
                <!-- Комментарии -->
                <?= $this->render('/other/comments');?>
            <?php endif; ?>

        </div>

        
    </div>
</div>