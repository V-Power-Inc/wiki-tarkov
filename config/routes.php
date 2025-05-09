<?php
/** Отдельный файл routes - сюда для удобства были вынесены все маршруты */

use app\controllers\{
    SiteController,
    SkillsController,
    ClanController,
    LootController,
    ItemController,
    MapsController,
    TraderController,
    BossesController,
    ApiController,
    FeedbackController
};

use app\modules\admin\controllers\DefaultController;

return [
    'admin/login' => DefaultController::routeId(DefaultController::ACTION_LOGIN),
    'admin/logout' => DefaultController::routeId(DefaultController::ACTION_LOGOUT),

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
    'maps/streets-of-tarkov-location' => MapsController::routeId(MapsController::ACTION_STREETS_OF_TARKOV),
    'maps/labyrinth-location' => MapsController::routeId(MapsController::ACTION_LABYRINTH),
    'quests-of-traders' => TraderController::routeId(TraderController::ACTION_QUESTS),
    'quests-of-traders/<url:[\w_\/-]+>' => TraderController::routeId(TraderController::ACTION_QUESTS_DETAIL),
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
    'loot/<action:[\w_\/-]+>/<url:[\w_\/-]+>' => LootController::routeId(LootController::ACTION_CATEGORY),
    'loot/<url:[\w_\/-]+>' => LootController::routeId(LootController::ACTION_CATEGORY),

    /** URL до страницы со списком боссов */
    'bosses' => BossesController::routeId(BossesController::ACTION_INDEX),

    /** URL до детальной страницы с боссами */
    'bosses/<url:[\w_\/-]+>' => BossesController::routeId(BossesController::ACTION_VIEW),

    /** URL до страницы, возвращающей запросы с успешными поисками для API */
    'items/search' => ApiController::routeId(ApiController::ACTION_SEARCH),

    /** URL до основной страницы API */
    'items' => ApiController::routeId(ApiController::ACTION_LIST),

    /** URL до детального предмета API */
    'item/<url:[\w_\/-]+>.html' => ApiController::routeId(ApiController::ACTION_ITEM),

    /** URL до экшена, который устанавливает куку, которая запоминает пользователю его цветовую палитру сайта */
    'change-layout' => SiteController::routeId(SiteController::ACTION_CHANGE_LAYOUT),

    /** URL до экшена, который через AJAX обновит данные графика HighCharts в API предметов */
    'get-graphs' => ApiController::routeId(ApiController::ACTION_GET_GRAPHS),

    /** URL до экшена, который рендерит страницу с формой обратной связи */
    'feedback-form' => FeedbackController::routeId(FeedbackController::ACTION_INDEX),

    /** Кастомный урл компонент */
    [
        'class' => 'app\components\UrlComponent',
    ]
];