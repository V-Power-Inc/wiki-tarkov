<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 10:50
 *
 * Это страница со списком карт, на которых можно встретить различных боссов
 *
 * @var $this yii\web\View
 * @var $maps Bosses - Объект боссов, в данном случае возвращает список карт из таблицы Bosses
 */

use app\models\Bosses;
use app\common\services\ImageService;

$this->title = 'Боссы на локациях Escape from Tarkov';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Боссы, которые встречаются на локациях Escape from Tarkov'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Боссы на локациях Escape from Tarkov, Escape from tarkov, Виды боссов'
]);
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
            <p class="alert alert-info size-16">В этом разделе вы сможете узнать что есть за боссы, которые встречаются на локациях Escape from Tarkov. Чтобы было проще разобраться какие могут быть боссы на локациях Escape from Tarkov - страница поделена на разделы карт.
            <br>
            <br>
            В каждом разделе - вы сможете узнать какие боссы встречаются на той или иной карте, есть ли у них охрана, какой шанс спавна босса на той или иной зоне внутри локации и так далее. Информация про зоны спавна боссов самая полезная, т.к. поможет вам избежать столкновения с боссом или наоборот - поможет выследить в случае, если у вас большой отряд.
            </p>
        </div>
    </div>

    <div class="row">
        <!-- Maps variables -->
        <?php foreach($maps as $map): ?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 margin-top-30 text-center">
                <h2 class="text-center boss-map-heading">Боссы на локации <?= $map->map ?></h2>
                <a href="/bosses/<?= $map->url ?>"><img class="boss-maps-img" src="<?= ImageService::mapImages($map->map) ?>"></a>
                <br>
                <br>
                <a class="btn btn-default main-link" href="/bosses/<?= $map->url ?>">Перейти к боссам локации <?= $map->map ?></a>
            </div>
        <?php endforeach; ?>
    </div>

</div>


<hr class="grey-line">

<!-- Gorizontal information -->
<div class="row margin-top-30">
    <div class="container">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>
