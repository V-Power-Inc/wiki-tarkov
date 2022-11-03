<?php
/** Отдельный файл routes - сюда для удобства были вынесены все маршруты */

use app\controllers\SiteController;
use app\controllers\SkillsController;
use app\controllers\ClanController;
use app\controllers\LootController;
use app\controllers\ItemController;
use app\controllers\MapsController;
use app\controllers\TraderController;
use app\controllers\BossesController;

use app\modules\admin\controllers\DefaultController;
use app\modules\admin\controllers\ModeratorController;

return [
    'admin/login' => DefaultController::routeId(DefaultController::ACTION_LOGIN),
    'admin/logout' => DefaultController::routeId(DefaultController::ACTION_LOGOUT),
    'admin/ass-destroyer' => ModeratorController::routeId(ModeratorController::ACTION_INDEX),

    '' => SiteController::routeId(SiteController::ACTION_INDEX),
    'table-patrons' => SiteController::routeId(SiteController::ACTION_TABLE_PATRONS),
    'offed-js' => SiteController::routeId(SiteController::ACTION_JSDISABLED),
    'traders/barterspreview' => TraderController::routeId(TraderController::ACTION_BARTERS_PREVIEW),
    'traders/previewtrader' => TraderController::routeId(TraderController::ACTION_PREVIEWTRADER),
    'maps' => MapsController::routeId(MapsController::ACTION_LOCATIONS),
    'maps/zavod-location' => MapsController::routeId(MapsController::ACTION_ZAVOD),
    'maps/forest-location' => MapsController::routeId(MapsController::ACTION_FOREST),
    'maps/tamojnya-location' => MapsController::routeId(MapsController::ACTION_TAMOJNYA),
    'maps/bereg-location' => MapsController::routeId(MapsController::ACTION_BEREG),
    'maps/razvyazka-location' => MapsController::routeId(MapsController::ACTION_RAZVYAZKA),
    'maps/terragroup-laboratory-location' => MapsController::routeId(MapsController::ACTION_LABORATORYTERRA),
    'maps/rezerv-location' => MapsController::routeId(MapsController::ACTION_REZERV),
    'maps/lighthouse-location' => MapsController::routeId(MapsController::ACTION_LIGHTHOUSE),
    'quests-of-traders' => TraderController::routeId(TraderController::ACTION_QUESTS),
    'quests-of-traders/prapor-quests' => TraderController::routeId(TraderController::ACTION_PRAPORPAGE),
    'quests-of-traders/terapevt-quests' => TraderController::routeId(TraderController::ACTION_TERAPEVTPAGE),
    'quests-of-traders/skypshik-quests' => TraderController::routeId(TraderController::ACTION_SKYPCHIKPAGE),
    'quests-of-traders/lyjnic-quests' => TraderController::routeId(TraderController::ACTION_LYJNICPAGE),
    'quests-of-traders/mirotvorec-quests' => TraderController::routeId(TraderController::ACTION_MIROTVORECPAGE),
    'quests-of-traders/mehanic-quests' => TraderController::routeId(TraderController::ACTION_MEHANICPAGE),
    'quests-of-traders/baraholshik-quests' => TraderController::routeId(TraderController::ACTION_BARAHOLSHIKPAGE),
    'quests-of-traders/eger-quests' => TraderController::routeId(TraderController::ACTION_EGERPAGE),
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

    /** URL до страницы со списком боссов */
    'bosses' => BossesController::routeId(BossesController::ACTION_INDEX),

    /** URL до детальной страницы с боссами */
    'bosses/<url:[\w_\/-]+>' => BossesController::routeId(BossesController::ACTION_VIEW),

    /** Кастомный урл компонент */
    [
        'class' => 'app\components\UrlComponent',
    ]
];