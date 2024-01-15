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

use app\controllers\BossesController;
use app\common\constants\api\BossAttributes;
use app\common\services\BossesService;
use app\common\services\ImageService;
use app\common\services\ArrayService;
use app\common\services\TranslateService;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Боссы на локации ' . $map_title->map . ' Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Боссы, которые встречаются на локации ' . $map_title->map . ' в Escape from Tarkov'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Боссы, ' . $map_title->map . ', Escape from Tarkov'
]);

/**
 * @var mixed $bosses - Массив с данными боссов обитающих на локации
 *
 * В этой вьюхе появилось довольно большое количество хардкода, в связи с несовершенством API tarkov.dev
 * по этому поводу был создан тикет у них в репозитории - стоит поглядывать периодически.
 *
 * @link https://github.com/the-hideout/tarkov-dev/issues/273
 */
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

<!-- Main page content -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <p class="alert alert-info size-16">В этом разделе вы узнаете какие есть отряды и боссы на локации <?= $map_title->map ?>. О боссах представлено много информации, внешний вид - свита и ее количество, вероятность спавна и прочие полезные атрибуты.
                <br>
                <br>
                Самое полезное, это наличие всех зон спавна для всех боссов присутствующих на карте <?= $map_title->map ?>. Это позволит планировать рейды таким образом, чтобы не встретиться с боссами или наоборт - выследить их с целью получить награду.
            </p>
        </div>
    </div>

    <!-- Main Page Content -->
    <div class="row">

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 keys-content">

            <?php if (empty($bosses)): ?>

                <!-- If bosses empty - set message -->
                <p class="alert alert-danger size-16">На этой локации в настоящее время нет каких-либо боссов.</p>
            <?php endif; ?>

            <!-- Cycle with all bosses on the map -->
            <?php foreach($bosses as $boss): ?>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 boss-page-bg">

                    <!-- Name -->
                    <h2 class="text-left"><?= BossesService::checkBossName($boss[BossAttributes::ATTR_NAME]) ?></h2>

                    <!-- Image -->
                    <div class="col-sm-2">
                        <img class="boss-image" src="<?= ImageService::bossImages($boss[BossAttributes::ATTR_NAME]) ?>" alt="<?= BossesService::checkBossName($boss[BossAttributes::ATTR_NAME]) ?>" title="<?= BossesService::checkBossName($boss[BossAttributes::ATTR_NAME]) ?>">
                    </div>

                    <!-- Attributes -->
                    <div class="col-sm-10">

                        <!-- More info about custom bosses -->
                        <?= TranslateService::bossesAlertInfo($boss[BossAttributes::ATTR_NAME]) ?>

                        <!-- Info about health bosses -->
                        <?= !empty(BossesService::healthBosses()[$boss[BossAttributes::ATTR_NAME]]) ? '<p class="boss-page-text boss-health">Здоровье:</p><div class="progress"><div class="progress-bar progress-bar-danger progress-bar-striped active custom-bar" role="progressbar" style="width: 100%" aria-valuenow="'. BossesService::healthBosses()[$boss[BossAttributes::ATTR_NAME]] .'" aria-valuemin="0" aria-valuemax="100">'. BossesService::healthBosses()[$boss[BossAttributes::ATTR_NAME]] .' HP</div></div>' : '' ?>

                        <p class="boss-page-text boss-faction">Фракция: <b><?= TranslateService::bossesFactions($boss[BossAttributes::ATTR_NAME]) ?></b></p>
                        <p class="boss-page-text boss-spawn-chance">Шанс спавна: <b><?= $boss[BossAttributes::ATTR_SPAWN_CHANCE] * 100 ?>%</b></p>
                        <p class="boss-page-text boss-spawn-locations">Зона спавна: <b><?= !empty($boss[BossAttributes::ATTR_SPAWN_LOCATIONS]) ? implode(', ', ArrayHelper::getColumn($boss[BossAttributes::ATTR_SPAWN_LOCATIONS], 'name')) : 'Не определено' ?></b>
                        <p class="boss-page-text boss-group">Действует в одиночку: <b><?= empty($boss[BossAttributes::ATTR_ESCORTS]) ? 'Да' : 'Нет' ?></b></p>
                        <?= !empty($boss[BossAttributes::ATTR_SPAWN_TRIGGER]) ? '<p class="boss-page-text boss-trigger">Триггер спавна: <b>'. $boss[BossAttributes::ATTR_SPAWN_TRIGGER] .'</b> </p>' : '' ?>

                        <?= !empty(BossesService::minionsNamesPrefix($boss[BossAttributes::ATTR_NAME])) ? '<p class="boss-page-text boss-minions-names">Позывные свиты или префиксы имен: <b>'. BossesService::minionsNamesPrefix($boss[BossAttributes::ATTR_NAME]) .'</b></p>' : '' ?>

                            <!-- Check of boss has escort -->
                            <?php if(!empty($boss[BossAttributes::ATTR_ESCORTS])): {

                                /** Выводим количество людей в составе отряда босса */
                                $cnt = ArrayService::getAmountEscorts($boss[BossAttributes::ATTR_ESCORTS]);
                            }
                            ?>

                                <?php if($boss[BossAttributes::ATTR_NAME] !== "Death Knight"): ?>
                                        <p class="boss-page-text boss-group-count">Всего в отряде сопровождения (Размер свиты): <b><?= $cnt > 1 ? '1-' . $cnt : '1' ?></b></p>
                                <?php endif; ?>

                            <?php endif; ?>

                        </p>
                    </div>
                </div>
            <?php endforeach;?>

            <!-- Relation -->
            <div class="recommended-gm-content">
               <?= $this->render('/other/google-recommended.php'); ?>
            </div>

            <!-- Комментарии -->
            <?= $this->render('/other/comments');?>

            <!-- back to main bosses page -->
            <a href="<?= Url::to(BossesController::getUrlRoute(BossesController::ACTION_INDEX)) ?>"><button type="button" class="btn btn-primary margin-top-15">Вернуться к списку локаций</button></a>

        </div>

        <!-- right block -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

            <!--Yandex direct -->
            <?= $this->render('/other/yandex-direct.php'); ?>
        </div>
    </div>
</div>
