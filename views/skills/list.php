<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 23.02.2018
 * Time: 23:17
 */

use app\models\Catskills;

/* @var Catskills[] $catskills - массив AR объектов категорий умений */

$this->title = 'Пассивные умения персонажа Escape from Tarkov';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'В Escape from Tarkov каждый персонаж обладает особыми навыками. Пассивные навыки разделяются на несколько категорий, каждый навык дает вашему персонажу определенные преимущества.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Пассивные умения в Escape from Tarkov',
]);
?>
<div class="interback-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="alert alert-info size-16 margin-bottom-0">
                    В Escape from Tarkov каждый персонаж обладает особыми навыками. Пассивные навыки разделяются на несколько категорий, <b>каждый навык дает вашему персонажу определенные преимущества</b>, также стоит понимать - что в бою и при ранениях шансы на выживание гораздо выше у персонажа с прокачанными навыками.
                    <br>
                    <br>
                    Кроме того, навыки влияют на большое количество характеристик, в том числе таких как выносливость, количество времени в течение которого вы можете обходиться без еды и воды, а также <b>могут значительно уменьшить шанс вашей смерти при критическом уроне</b>.
                    <br>
                    <br>
                    В этом разделе вы узнаете все о пассивных навыках персонажа в Escape from Tarkov, сможете найти рекомендации о том какие навыки стоит прокачивать в первую очередь, а также узнаете <b>нестандартные способы их ускоренной прокачки</b>.
                </p>
            </div>
        </div>
    </div>
</div>

<hr class="grey-line">

    <!-- Список активных категорий умений -->
<?php foreach($catskills as $cat) : ?>
    <div class="<?= $cat[Catskills::ATTR_BG_STYLE] ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: inline-block; z-index: 100">
                    <h2 class="mobile-text-center">
                        <a href="/skills/<?= $cat[Catskills::ATTR_URL] ?>"><?= $cat[Catskills::ATTR_TITLE] ?></a>
                    </h2>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 mobile-text-center">
                    <a href="/skills/<?= $cat[Catskills::ATTR_URL] ?>"><img class="image-trader" src="<?= $cat[Catskills::ATTR_PREVIEW] ?>" style="max-width: 100%;" alt="<?= $cat[Catskills::ATTR_TITLE] ?>"></a>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <?= $cat[Catskills::ATTR_CONTENT] ?>
                    <br>
                    <p class="mobile-text-center">
                        <a class="btn btn-default main-link float-right" href="/skills/<?= $cat[Catskills::ATTR_URL] ?>">Перейти в подробный раздел</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<hr class="grey-line">

<!-- Gorizontal information -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 gor-pds">
            <?= $this->render('/other/google-gor'); ?>
        </div>
    </div>
</div>


