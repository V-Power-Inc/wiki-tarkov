<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.10.2017
 * Time: 15:15
 */

use app\models\Traders;

/* @var Traders[] $traders - массив объектов трейдеров */

$this->title = 'Торговцы в Escape from Tarkov - описания торговцев и разбор квестов';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Торговцы в Escape from Tarkov - описания торговцев и разбор квестов - прохождения заданий Escape from Tarkov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Квесты Escape from Tarkov, Задачи торговцев, квесты в Таркоеве',
]);
?>
<!-- Gorizontal information -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>

<hr class="grey-line">

<!-- Список активных торговцев Таркова -->
<?php foreach($traders as $trader): ?>
    <div class="<?= $trader[Traders::ATTR_BG_STYLE] ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block; z-index: 100">
                    <h2 class="mobile-text-center">
                        <?php if ($trader[Traders::ATTR_URL] !== '' && $trader[Traders::ATTR_URL] !== null): ?>
                            <a href="/traders/<?= $trader[Traders::ATTR_URL] ?>"><?= $trader[Traders::ATTR_TITLE] ?></a>
                        <?php else :?>
                            <p><?= $trader[Traders::ATTR_TITLE] ?></p>
                        <?php endif; ?>
                    </h2>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 mobile-text-center">

                    <?php if ($trader[Traders::ATTR_URL] !== '' && $trader[Traders::ATTR_URL] !== null): ?>
                        <a href="/traders/<?= $trader[Traders::ATTR_URL] ?>"><img class="image-trader" src="<?= $trader[Traders::ATTR_PREVIEW] ?>" style="max-width:100%;" alt="<?= $trader[Traders::ATTR_TITLE] ?>"></a>
                    <?php else :?>
                        <a><img class="image-trader" src="<?= $trader[Traders::ATTR_PREVIEW] ?>" style="max-width:100%;" alt="<?= $trader[Traders::ATTR_TITLE] ?>"></a>
                    <?php endif; ?>
              
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <?= $trader[Traders::ATTR_CONTENT] ?>
                    <br>
                    <p class="mobile-text-center">
                        <?php if ($trader[Traders::ATTR_URLTOQUETS] !== '' && $trader[Traders::ATTR_URLTOQUETS] !== null): ?>
                            <a class="btn btn-default main-link float-right mobile-btn-margin" href="<?= $trader[Traders::ATTR_URLTOQUETS] ?>"><?= $trader[Traders::ATTR_BUTTON_QUESTS] ?></a>
                        <?php endif; ?>

                        <?php if ($trader[Traders::ATTR_URL] !== '' && $trader[Traders::ATTR_URL] !== null): ?>
                            <a class="btn btn-default main-link float-left mobile-btn-margin" href="/traders/<?= $trader[Traders::ATTR_URL] ?>"><?= $trader[Traders::ATTR_BUTTON_DETAIL] ?></a>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Gorizontal information -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>