<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'База знаний Escape from Tarkov. Карты локаций, ключи от дверей, разбор квестов торговцев';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Интерактивные карты локаций, описания квестов торговцев и их прохождения, карта ключей от помещений.',
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Интерактивные карты локаций Escape from Tarkov, квесты Escape from Tarkov, Ключи Escape from Tarkov.',
]);

/** Основные разделы сайта для сетки карточек на главной странице */
$sections = [
    [
        'title' => 'Задачи у торговцев',
        'url' => '/quests-of-traders',
        'image' => '/img/mainpage/traders.png',
        'icon' => 'fa-users',
        'text' => 'Все доступные квесты торговцев: описания, рекомендации по прохождению и неочевидные нюансы, о которых стоит знать заранее.',
        'link' => 'К квестам торговцев',
    ],
    [
        'title' => 'Ключи от дверей',
        'url' => '/keys',
        'image' => '/img/mainpage/keys.png',
        'icon' => 'fa-key',
        'text' => 'Где найти нужный ключ, как выглядят открываемые им двери и что ждёт вас внутри запертых помещений.',
        'link' => 'К справочнику ключей',
    ],
    [
        'title' => 'Карты локаций',
        'url' => '/maps',
        'image' => '/img/mainpage/maps.png',
        'icon' => 'fa-map',
        'text' => 'Интерактивные карты с выходами, ключами, спавнами и квестовыми точками. Незаменимый инструмент перед каждым рейдом.',
        'link' => 'К интерактивным картам',
    ],
    [
        'title' => 'Справочник лута',
        'url' => '/loot',
        'image' => '/img/mainpage/mainloot.png',
        'icon' => 'fa-cube',
        'text' => 'Вся информация о предметах Таркова: от бесполезного хлама до оружия, модулей и экипировки.',
        'link' => 'К справочнику лута',
    ],
    [
        'title' => 'Справочник умений',
        'url' => '/skills',
        'image' => '/img/mainpage/skills.png',
        'icon' => 'fa-line-chart',
        'text' => 'Умения персонажа, доступные к прокачке, и их влияние на выживаемость. Цифры — из официальных материалов разработчиков.',
        'link' => 'К справочнику умений',
    ],
    [
        'title' => 'Квестовый лут',
        'url' => '/loot/quest-loot',
        'image' => '/img/mainpage/questloot.png',
        'icon' => 'fa-flag',
        'text' => 'Какие предметы обязательно сохранить для квестов, а какие можно смело продавать торговцам.',
        'link' => 'К квестовым предметам',
    ],
];

/** Быстрые ссылки на интерактивные карты локаций */
$maps = [
    'Завод' => '/maps/zavod-location#3/68.97/-8.00',
    'Таможня' => '/maps/tamojnya-location#4/80.40/-75.98',
    'Лес' => '/maps/forest-location#3/72.50/-9.58',
    'Берег' => '/maps/bereg-location#3/60.93/-10.81',
    'Развязка' => '/maps/razvyazka-location#3/75.32/-44.38',
    'Лаборатория' => '/maps/terragroup-laboratory-location#2/41.0/-1.2',
    'Резерв' => '/maps/rezerv-location#2/64.6/41.0',
    'Маяк' => '/maps/lighthouse-location#2/74.0/65.2',
    'Улицы Таркова' => '/maps/streets-of-tarkov-location#2/59.2/34.3',
    'Эпицентр' => '/maps/epicenter#2/48.7/-24.8',
    'Лабиринт' => '/maps/labyrinth-location#2/60.8/-86.0',
];
?>

<!-- Главный баннер -->
<section class="home-hero">
    <div class="container">
        <div class="home-hero__content">
            <span class="home-hero__eyebrow"><i class="fa fa-crosshairs"></i> Справочник выживания</span>

            <h1 class="home-hero__title">База знаний <span>Escape from Tarkov</span></h1>

            <p class="home-hero__lead">Квесты торговцев, ключи от дверей, интерактивные карты и справочник лута — всё, что нужно, чтобы вернуться из рейда живым.</p>

            <div class="home-hero__actions">
                <a class="home-btn home-btn--primary" href="/maps"><i class="fa fa-map"></i> Перейти к интерактивным картам Escape from Tarkov</a>
                <a class="home-btn home-btn--ghost" href="/quests-of-traders"><i class="fa fa-users"></i> Квесты торговцев</a>
            </div>

            <div class="home-hero__stats">
                <div class="home-hero__stat"><b><?= count($maps) ?></b><span>интерактивных карт</span></div>
                <div class="home-hero__stat"><b>8</b><span>торговцев с квестами</span></div>
                <div class="home-hero__stat"><b>2017</b><span>работаем с этого года</span></div>
            </div>
        </div>
    </div>
</section>

<!-- Место под рекламный блок -->
<div class="no-adb"></div>

<!-- Основные разделы -->
<section class="home-section">
    <div class="container">
        <div class="home-section__head">
            <h2>Разделы базы знаний</h2>
            <p>Здесь собрана информация о важных аспектах внутриигрового процесса — выберите, с чего начать.</p>
        </div>

        <div class="home-grid">
            <?php foreach ($sections as $section): ?>
                <a class="home-card" href="<?= Html::encode($section['url']) ?>">
                    <div class="home-card__media-wrap">
                        <div class="home-card__media">
                            <img src="<?= Html::encode($section['image']) ?>" alt="<?= Html::encode($section['title']) ?>" loading="lazy">
                        </div>
                        <span class="home-card__icon"><i class="fa <?= Html::encode($section['icon']) ?>"></i></span>
                    </div>
                    <div class="home-card__body">
                        <h3 class="home-card__title"><?= Html::encode($section['title']) ?></h3>
                        <p class="home-card__text"><?= Html::encode($section['text']) ?></p>
                        <span class="home-card__more"><?= Html::encode($section['link']) ?> <i class="fa fa-arrow-right"></i></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Место под дополнительный рекламный блок -->
<div class="no-adb"></div>

<!-- Быстрый переход к картам локаций -->
<section class="home-maps">
    <div class="container">
        <div class="home-section__head">
            <h2>Быстрый переход к картам</h2>
            <p>Откройте интерактивную карту нужной локации в один клик.</p>
        </div>

        <div class="home-chips">
            <?php foreach ($maps as $name => $url): ?>
                <a class="home-chip" href="<?= Html::encode($url) ?>"><i class="fa fa-map-marker"></i> <?= Html::encode($name) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
