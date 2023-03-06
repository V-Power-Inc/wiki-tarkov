<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 22.10.2017
 * Time: 15:15
 */

use yii\web\JqueryAsset;
use app\common\services\ImageService;
use app\common\services\TranslateService;
use app\common\models\tasks\TaskItem;

/* @var TaskItem[] $tasks - Массив объектов с квестами конкретного торговца */

/** Сетапим переменной имя торговца для текущей страницы */
$trader_name = $tasks[0]->trader->name;

$this->registerJsFile('js/tabs-quests.js', ['depends' => [JqueryAsset::class]]);
$this->title = 'Квесты торговца ' . $trader_name . ' в Escape from Tarkov. Разбор и прохождение квестов - ' . $trader_name;
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Прохождение и разбор квестов торговца ' . $trader_name . ' по онлайн-шутеру Escape from Takov.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Квесты торговца ' . $trader_name . ' в Escape from Tarkov, квесты '. $trader_name .' Тарков',
]);
?>
<div class="container">
    <div class="row">

        <!-- no-scale -->
        <div class="col-lg-12">
            <?= $this->render('/other/google-gor.php'); ?>
        </div>
        
        <!-- Меню левой части страницы -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <ul class="nav nav-list bs-docs-sidenav">
                <?php foreach ($tasks as $task): ?>
                    <li><a data-toggle="tab" href="#<?=$task->id?>" class="relative"><i class="fa fa-chevron-right"></i><?=$task->name?></a></li>
                <?php endforeach; ?>
            </ul>

            <!-- Essense -->
            <?= $this->render('/other/yandex-direct.php'); ?>

        </div>
        
        <!-- Основное содержимое страницы -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 quests-content">
            <div class="info-quests" id="info-alert-prapor" style="display: none;">
                <p class="alert alert-info sm-vertical-margin-20 size-16"> <?= TranslateService::getTraderQuestDesc($trader_name) ?></p>
                <img class="torgovec-info-quest-image" src="<?= ImageService::questsTraderImages($trader_name) ?>" alt="Квесты торговца <?= $trader_name ?> из Escape from Tarkov">
            </div>
                <div class="tab-content">

                    <?php foreach ($tasks as $task): ?>
                    <div id="<?=$task->id?>" class="tab-pane fade">

                        <!-- Блок с информацией о квесте -->
                        <div class="row">

                            <!-- Блок изображения торговца, что выдает квест -->
                            <div class="col-xs-2">
                                <img class="trader-quest-icon" src="<?= $task->trader->imageLink ?>" alt="<?= $task->trader->name ?>" title="<?= $task->trader->name ?>">
                            </div>

                            <!-- Блок атрибутов квеста -->
                            <div class="col-xs-10">

                                <!-- Название квеста -->
                                <p class="title-of-item-block">Название квеста: <span class="red"><?= $task->name ?></span></p>

                                <p class="title-of-item-block">Минимальный уровень персонажа для взятия квеста: <span class="red"><?= $task->minPlayerLevel ?> LVL</span></p>

                                <!-- Какая фракция может взять квест -->
                                <p class="title-of-item-block">Для какой фракции квест: <span class="red"><?= TranslateService::getQuestFaction($task->factionName) ?></span></p>

                                <!-- Сколько опыта дадут за квест -->
                                <p class="title-of-item-block">Опыта за квест: <span class="red"><?= $task->experience ?> EXP</span></p>

                                <!-- На какой локации выполняется квест -->
                                <p class="title-of-item-block">Выполняется на локации: <span class="red"><?= $task->map->name ?? 'Любая' ?></span></p>

                                <!-- Является ли квест рестартуемым -->
                                <p class="title-of-item-block">Можно выполнить многократно: <span class="red"><?= ($task->restartable == true) ? 'Да' : 'Нет' ?></span></p>

                                <!-- Условия выполнения задания -->
                                <p class="title-of-item-block">Цели задания: <br>

                                    <span class="red size-16">
                                        <?php foreach($task->objectives->_items as $objective): ?>
                                            - <?= $objective->description ?> <br>
                                        <?php endforeach; ?>
                                    </span>
                                </p>

                                <?php if (!empty($task->neededKeys->_items)): ?>

                                    <!-- Какие ключи понадобятся для выполнения квеста -->
                                    <p class="title-of-item-block">Необходимые ключи: </p>

                                    <div class="keys-for-quest">

                                        <div class="barter-items-count">

                                        <?php foreach($task->neededKeys->_items as $_key): ?>
                                            <img class="items-for-trade" src="<?= $_key['iconLink'] ?>" title="<?= $_key['name'] ?>" alt="<?= $_key['name'] ?>">
                                        <?php endforeach; ?>

                                        </div>

                                    </div>

                                <?php endif; ?>


                                <?php if (!empty($task->taskRequirements->_items)): ?>

                                    <!-- Какие задачи должны быть выполнены для получения задания -->
                                    <p class="title-of-item-block">Статусы других квестов: <br>

                                        <span class="red size-16">
                                            <?php foreach($task->taskRequirements->_items as $taskRequirement): ?>
                                                <?php foreach($taskRequirement->status as $key => $value): ?>
                                                    <?= $taskRequirement->task ?> должен быть <b><?= TranslateService::getTaskStatus($value) ?></b>

                                                        <?php if(count($taskRequirement->status) > 1): ?>
                                                            <?php if(array_key_last($taskRequirement->status) !== $key): ?>
                                                            или
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                            <br>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </span>
                                    </p>

                                <?php endif; ?>

                                <?php if(!empty($task->startRewards->_items)): ?>

                                    <!-- Какие предметы понадобятся для выполнения задания -->
                                    <p class="title-of-item-block">Предметы необходимые для выполнения задания: </p>

                                    <div class="keys-for-quest">

                                        <div class="barter-items-count">

                                            <?php foreach($task->startRewards->_items as $startReward): ?>
                                                <span class="count-for-barter"> <b><?= $startReward->count ?>x</b></span> <img class="items-for-trade" src="<?= $startReward->iconLink ?>" title="<?= $startReward->name ?>" alt="<?= $startReward->name ?>">
                                            <?php endforeach; ?>

                                        </div>

                                    </div>
                                <?php endif; ?>

                                <?php if(!empty($task->finishRewards->_items)): ?>

                                    <!-- Какие предметы понадобятся для выполнения задания -->
                                    <p class="title-of-item-block">Предметы выдаваемые за выполнение задания: </p>

                                    <div class="keys-for-quest">

                                        <div class="barter-items-count">

                                            <?php foreach($task->finishRewards->_items as $finishReward): ?>
                                                <span class="count-for-barter"> <b><?= $finishReward->count ?>x</b></span> <img class="items-for-trade" src="<?= $finishReward->iconLink ?>" title="<?= $finishReward->name ?>" alt="<?= $finishReward->name ?>">
                                            <?php endforeach; ?>

                                        </div>

                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>

                    </div>
                    <?php endforeach; ?>
                </div>

            <br>
            <button class="btn btn-primary"><a href="/quests-of-traders" style="color: white; text-decoration: none;">Вернуться к списку торговцев</a></button>
        </div>

        <!-- Расстояние заглушка -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 height-25"></div>

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 nulled-pdng bordered-recomend">
            <?= $this->render('/other/google-recommended.php'); ?>
        </div>

        <!-- Расстояние заглушка -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 height-25"></div>

        <!-- Комментарии -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 comment-fake-side">
            <?= $this->render('/other/comments');?>
        </div>

        <!-- Core -->
        <div class="recommended-gm-content">
            <?= $this->render('/other/google-recommended.php'); ?>
        </div>

    </div>
</div>