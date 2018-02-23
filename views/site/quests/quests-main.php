<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.10.2017
 * Time: 15:15
 */
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
<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Торговцы в Escape from Tarkov</h1>
    </div>
</div>

<hr class="grey-line">

<!-- Список активных торговцев Таркова -->
<?php foreach($traders as $trader) : ?>
    <div class="<?= $trader['bg_style'] ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block; z-index: 100">
                    <h2 class="mobile-text-center">
                        <?php if ($trader['url'] !== '' && $trader['url'] !== null): ?>
                            <a href="/traders/<?= $trader['url'] ?>"><?= $trader['title'] ?></a>
                        <?php else :?>
                            <a><?= $trader['title'] ?></a>
                        <?php endif; ?>
                    </h2>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 mobile-text-center">

                    <?php if ($trader['url'] !== '' && $trader['url'] !== null): ?>
                        <a href="/traders/<?= $trader['url'] ?>"><img class="image-trader" src="<?= $trader['preview'] ?>" style="max-width:100%;" alt="<?= $trader['title'] ?>"></a>
                    <?php else :?>
                        <a><img class="image-trader" src="<?= $trader['preview'] ?>" style="max-width:100%;" alt="<?= $trader['title'] ?>"></a>
                    <?php endif; ?>
              
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <?= $trader['content'] ?>
                    <br>
                    <p class="mobile-text-center">
                        <?php if ($trader['urltoquets'] !== '' && $trader['urltoquets'] !== null): ?>
                            <a class="btn btn-default main-link float-right mobile-btn-margin" href="<?= $trader['urltoquets'] ?>"><?= $trader['button_quests'] ?></a>
                        <?php endif; ?>

                        <?php if ($trader['url'] !== '' && $trader['url'] !== null): ?>
                            <a class="btn btn-default main-link float-left mobile-btn-margin" href="/traders/<?= $trader['url'] ?>"><?= $trader['button_detail'] ?></a>
                        <? endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


