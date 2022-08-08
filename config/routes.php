<?php
/** Отдельный файл routes - сюда для удобства были вынесены все маршруты */

use app\controllers\SiteController;
use app\controllers\SkillsController;
use app\controllers\ClanController;
use app\controllers\LootController;
use app\controllers\ItemController;

use app\components\UrlComponent;
use app\components\SkillsurlComponent;
use app\components\CategoryurlComponent;

use app\modules\admin\controllers\DefaultController;
use app\modules\admin\controllers\ModeratorController;

return [
    'admin/login' => DefaultController::routeId(DefaultController::ACTION_LOGIN),
    'admin/logout' => DefaultController::routeId(DefaultController::ACTION_LOGOUT),
    'admin/ass-destroyer' => ModeratorController::routeId(ModeratorController::ACTION_INDEX),

    '' => SiteController::routeId(SiteController::ACTION_INDEX),
    'table-patrons' => SiteController::routeId(SiteController::ACTION_TABLE_PATRONS),
    'offed-js' => SiteController::routeId(SiteController::ACTION_JSDISABLED),
    'barter/preview' => SiteController::routeId(SiteController::ACTION_BARTERS_PREVIEW),
    'trader/preview' => SiteController::routeId(SiteController::ACTION_PREVIEWTRADER),
    'maps' => SiteController::routeId(SiteController::ACTION_LOCATIONS),
    'maps/zavod-location' => SiteController::routeId(SiteController::ACTION_ZAVOD),
    'maps/forest-location' => SiteController::routeId(SiteController::ACTION_FOREST),
    'maps/tamojnya-location' => SiteController::routeId(SiteController::ACTION_TAMOJNYA),
    'maps/bereg-location' => SiteController::routeId(SiteController::ACTION_BEREG),
    'maps/razvyazka-location' => SiteController::routeId(SiteController::ACTION_RAZVYAZKA),
    'maps/terragroup-laboratory-location' => SiteController::routeId(SiteController::ACTION_LABORATORYTERRA),
    'maps/rezerv-location' => SiteController::routeId(SiteController::ACTION_REZERV),
    'maps/lighthouse-location' => SiteController::routeId(SiteController::ACTION_LIGHTHOUSE),
    'quests-of-traders' => SiteController::routeId(SiteController::ACTION_QUESTS),
    'quests-of-traders/prapor-quests' => SiteController::routeId(SiteController::ACTION_PRAPORPAGE),
    'quests-of-traders/terapevt-quests' => SiteController::routeId(SiteController::ACTION_TERAPEVTPAGE),
    'quests-of-traders/skypshik-quests' => SiteController::routeId(SiteController::ACTION_SKYPCHIKPAGE),
    'quests-of-traders/lyjnic-quests' => SiteController::routeId(SiteController::ACTION_LYJNICPAGE),
    'quests-of-traders/mirotvorec-quests' => SiteController::routeId(SiteController::ACTION_MIROTVORECPAGE),
    'quests-of-traders/mehanic-quests' => SiteController::routeId(SiteController::ACTION_MEHANICPAGE),
    'quests-of-traders/baraholshik-quests' => SiteController::routeId(SiteController::ACTION_BARAHOLSHIKPAGE),
    'currencies' => SiteController::routeId(SiteController::ACTION_CURRENCIES),
    'keys' => SiteController::routeId(SiteController::ACTION_KEYS),
    'news' => SiteController::routeId(SiteController::ACTION_NEWS),
    'articles' => SiteController::routeId(SiteController::ACTION_ARTICLES),
    'questions' => SiteController::routeId(SiteController::ACTION_QUESTIONS),
    'site/keysjson' => SiteController::routeId(SiteController::ACTION_KEYSJSON),

    'clan/clansearch' => ClanController::routeId(ClanController::ACTION_CLANSEARCH),
    'clan/save' => ClanController::routeId(ClanController::ACTION_SAVE),
    'clans' => ClanController::routeId(ClanController::ACTION_INDEX),
    'add-clan' => ClanController::routeId(ClanController::ACTION_ADDCLAN),

    'skills' => SkillsController::routeId(SkillsController::ACTION_MAINSKILLS),

    'item/preview' => ItemController::routeId(ItemController::ACTION_PREVIEWLOOT),

    'loot/lootjson' => LootController::routeId(LootController::ACTION_LOOTJSON),
    'loot/quest-loot' => LootController::routeId(LootController::ACTION_QUESTLOOT),
    'loot' => LootController::routeId(LootController::ACTION_MAINLOOT),
    'loot/<action:[\w_\/-]+>/<name:[\w_\/-]+>' => LootController::routeId(LootController::ACTION_CATEGORY),
    'loot/<name:[\w_\/-]+>' => LootController::routeId(LootController::ACTION_CATEGORY),

    UrlComponent::class,
    SkillsurlComponent::class,
    CategoryurlComponent::class
];