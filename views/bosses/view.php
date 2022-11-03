<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 14:19
 *
 * Вьюха с детальной информацией о боссах, которые присутствуют на конкретной карте
 *
 * @var $this yii\web\View
 * @var $map_title app\models\Bosses - Название текущей карты
 * @var $boss array - Массив с информацией о боссах на конкретной карте (Фактически раскодированный Json)
 */

$this->title = 'Боссы на локации ' . $map_title->map . ' Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Боссы, которые встречаются на локации ' . $map_title->map . ' в Escape from Tarkov'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Боссы, ' . $map_title->map . ', Escape from Tarkov'
]);

use app\common\services\ImageService;
use yii\helpers\ArrayHelper;
use app\common\services\ArrayService;
?>

<!-- Gorizontal information -->
<div class="row">
    <div class="container">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>

<hr class="grey-line">

<!-- Main page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <p class="alert alert-info size-16">В этом разделе вы узнаете что какие есть боссы на локации <?= $map_title->map ?>. О боссах представлено много информации, внешний вид - свита и ее количество, вероятность спавна и прочие полезные атрибуты.
                <br>
                <br>

            </p>
        </div>
    </div>

    <!-- Main Page Content -->
    <div class="row">

        <!-- Cycle with all bosses on the map -->
        <?php foreach($bosses as $boss): ?>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 boss-page-bg">

                <!-- Name -->
                <h2 class="text-left"><?= $boss['name'] ?></h2>

                <!-- Image -->
                <div class="col-sm-2">
                    <img class="boss-image" src="<?= ImageService::bossImages($boss['name']) ?>">
                </div>

                <!-- todo: Сделать метод, который на лету переведет английские вариации -->
                <!-- Attributes -->
                <div class="col-sm-10">
                    <p class="boss-page-text boss-spawn-chance">Шанс спавна: <b><?= $boss['spawnChance'] ?>%</b></p>
                    <p class="boss-page-text boss-spawn-locations">Шанс спавна: <b><?= implode(', ', ArrayHelper::getColumn($boss['spawnLocations'], 'name')) ?></b>
                    <p class="boss-page-text boss-group">Действует в одиночку: <b><?= empty($boss['escorts']) ? 'Да' : 'Нет' ?></b></p>
                    <p class="boss-page-text boss-spawn-time">Спавнится при определенных условиях или ночью: <b><?= ($boss['spawnTimeRandom'] == 'true') ? 'Да' : 'Нет' ?></b>

                    <!-- Check of boss has escort -->
                    <?php if(!empty($boss['escorts'])): {
                        /** Выводим количество людей в составе отряда босса */
                        $cnt = ArrayService::getAmountEscorts($boss['escorts']);
                    }
                    ?>
                        <p class="boss-page-text boss-group-count">Всего в отряде: <b>1 - <?= $cnt ?></b></p>
                    <?php endif; ?>

                    </p>
                </div>
            </div>

        <?php endforeach;?>
    </div>
</div>
