<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 18.03.2019
 * Time: 6:12
 */

$this->registerJsFile('js/tabs-quests.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Реквизиты для донатов - tarkov-wiki.ru';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Реквизиты для донатов - tarkov-wiki.ru',
]);

use app\components\AlertComponent;
?>

<div class="heading-class">
    <div class="container">
        <h1 class="main-site-heading">Реквизиты для донатов</h1>
    </div>
</div>

<hr class="grey-line" style="border-top: 0;">

<?php if((AlertComponent::alert()->enabled !== 0)) : ?>
    <!-- Информационная строка -->
    <div class="row">
        <div class="container">
            <div class="col-lg-12 <?= AlertComponent::alert()->bgstyle ?>">
                <marquee style="font-size: 16px; color: white; font-weight: bold; margin-top: 4px;"><?= AlertComponent::alert()->content ?></marquee>
            </div>
        </div>
    </div>
    <hr class="grey-line">
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 donates-content">
            <p class="alert alert-info size-16">
                На этой странице вы можете задонатить проекту <b>tarkov-wiki</b>. Актуализация контента это очень сложная работа, которая требует постоянной вовлеченности в процесс. Ниже опубликованы реквизиты для донатов - спасибо за то что вы с нами и поддерживаете нас!
            </p>

            <p class="size-donates">WebMoney: <span>R999999999999</span></p>
            <p class="size-donates">Qiwi: <span>+79999999999</span></p>
            <p class="size-donates">Яндекс Кошелек: <span>999999999999999</span></p>
        </div>
    </div>
</div>