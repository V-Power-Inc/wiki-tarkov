<?php

use app\modules\admin\controllers\CategoryController;
use app\modules\admin\controllers\ItemsController;
use app\modules\admin\controllers\ZavodController;
use app\modules\admin\controllers\ForestController;
use app\modules\admin\controllers\TamojnyaController;
use app\modules\admin\controllers\BeregController;
use app\modules\admin\controllers\RazvyazkaController;
use app\modules\admin\controllers\ClansController;
use app\modules\admin\controllers\BartersController;
use app\modules\admin\controllers\QuestionsController;
use app\modules\admin\controllers\CatskillsController;
use app\modules\admin\controllers\SkillsController;
use app\modules\admin\controllers\TradersController;
use app\modules\admin\controllers\DoorkeysController;
use app\modules\admin\controllers\NewsController;
use app\modules\admin\controllers\ArticlesController;
use app\modules\admin\controllers\CurrenciesController;
use app\modules\admin\controllers\FeedbackmessagesController;

use yii\helpers\Url;

$this->title = 'Админка '. $_ENV['DOMAIN'];

/** Вьюха главной страницы админки - сюда попадаем после успешной авторизации */
?>
<div class="col-lg-12 text-center">
    <h1 class="admin-title-main">Главная админская страница</h1>
</div>

<!-- Верхний блок с контентом -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <ul class="nav nav-pills nav-stacked">
        <h2 class="text-center margin-bottom-30">Работа со справочником лута</h2>
        <div class="text-center">
            <li class="d-inline category-admin-margins"><a href="<?= Url::to(CategoryController::getUrlRoute(CategoryController::ACTION_INDEX)) ?>" class="admin-inline">Категории справочника лута</a></li>
            <li class="d-inline category-admin-margins"><a href="<?= Url::to(ItemsController::getUrlRoute(ItemsController::ACTION_INDEX)) ?>" class="admin-inline">Лут в справочнике лута</a></li>
        </div>
    </ul>
</div>

<!-- Левый блок с контентом -->
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-top-30">
    <ul class="nav nav-pills nav-stacked">
        <h2 class="text-center">Маркеры на картах</h2>
        <li><a href="<?= Url::to(ZavodController::getUrlRoute(ZavodController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Маркеры на локации Завод</a></li>
        <li><a href="<?= Url::to(ForestController::getUrlRoute(ForestController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Маркеры на локации Лес</a></li>
        <li><a href="<?= Url::to(TamojnyaController::getUrlRoute(TamojnyaController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Маркеры на локации Таможня</a></li>
        <li><a href="<?= Url::to(BeregController::getUrlRoute(BeregController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Маркеры на локации Берег</a></li>
        <li><a href="<?= Url::to(RazvyazkaController::getUrlRoute(RazvyazkaController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Маркеры на локации Развязка</a></li>
    </ul>
</div>

<!-- Правый блок с контентом -->
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-top-30">
    <ul class="nav nav-pills nav-stacked">
        <h2 class="text-center">Дополнительно</h2>
        <li><a href="<?= Url::to(ClansController::getUrlRoute(ClansController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Заявки кланов</a></li>
        <li><a href="<?= Url::to(BartersController::getUrlRoute(BartersController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Бартеры торговцев</a></li>
        <li><a href="<?= Url::to(QuestionsController::getUrlRoute(QuestionsController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Часто задаваемые вопросы</a></li>
        <li><a href="<?= Url::to(CatskillsController::getUrlRoute(CatskillsController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Категории умений</a></li>
        <li><a href="<?= Url::to(SkillsController::getUrlRoute(SkillsController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Пассивные умения</a></li>
        <li><a href="<?= Url::to(TradersController::getUrlRoute(TradersController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Торговцы</a></li>
        <li><a href="<?= Url::to(DoorkeysController::getUrlRoute(DoorkeysController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Справочник ключей</a></li>
        <li><a href="<?= Url::to(NewsController::getUrlRoute(NewsController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Новости</a></li>
        <li><a href="<?= Url::to(ArticlesController::getUrlRoute(ArticlesController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Полезные статьи</a></li>
        <li><a href="<?= Url::to(CurrenciesController::getUrlRoute(CurrenciesController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Курсы валют</a></li>
        <li><a href="<?= Url::to(FeedbackmessagesController::getUrlRoute(FeedbackmessagesController::ACTION_INDEX)) ?>" class="admin-tabs w-100-important">Обратная связь с сайта</a></li>

        <!-- disabled -->
        <li><a href="#" class="admin-tabs w-100-important unactive">Контент в описаниях маркеров</a></li>
    </ul>
</div>