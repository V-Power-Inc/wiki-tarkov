<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 02.08.2022
 * Time: 20:49
 *
 * Пути проекта вынесены в отдельный файл
 */

use app\controllers\AdvancedController;

return [
    '' => 'site/index',
    // 'donates' => 'site/donates',
    'savereview' => 'site/savereview',
    'table-patrons' => 'site/table-patrons',
    'reviews' => 'site/reviews',
    'offed-js' => 'site/jsdisabled',
    'parse-pidors' => 'site/parse-pidors',
    'admin/ass-destroyer' => 'admin/moderator/index',
    'barter/preview' => 'site/barters-preview',
    'trader/preview' => 'site/previewtrader',
    'admin/login' => 'admin/default/logout',
    'maps' => 'site/locations',
    'maps/zavod-location' => 'site/zavod',
    'maps/forest-location' => 'site/forest',
    'maps/tamojnya-location' => 'site/tamojnya',
    'maps/bereg-location' => 'site/bereg',
    'maps/razvyazka-location' => 'site/razvyazka',
    'maps/terragroup-laboratory-location' => 'site/laboratoryterra',
    'maps/rezerv-location' => 'site/rezerv',
    'maps/lighthouse-location' => 'site/lighthouse',
    'quests-of-traders' => 'site/quests',
    'quests-of-traders/prapor-quests' => 'site/praporpage',
    'quests-of-traders/terapevt-quests' => 'site/terapevtpage',
    'quests-of-traders/skypshik-quests' => 'site/skypchikpage',
    'quests-of-traders/lyjnic-quests' => 'site/lyjnicpage',
    'quests-of-traders/mirotvorec-quests' => 'site/mirotvorecpage',
    'quests-of-traders/mehanic-quests' => 'site/mehanicpage',
    'quests-of-traders/baraholshik-quests' => 'site/baraholshikpage',
    //  'quests-of-traders/leshy-quests' => 'site/leshypage',
    //  'quests-of-traders/warden-quests' => 'site/wardenpage',
    //  'quests-of-traders/bashkir-quests' => 'site/bashkirpage',
    //  'quests-of-traders/khokhol-quests' => 'site/khokholpage',
    'currencies' => 'site/currencies',
    'clan/clansearch' => 'clan/clansearch',
    'clan/save' => 'clan/save',
    'clans' => 'clan/index',
    'add-clan' => 'clan/addclan',
    'keys' => 'site/keys',
    'news' => 'site/news',
    'skills' => 'skills/mainskills',
    'traders' => 'site/traders301',
    'articles' => 'site/articles',
    'questions' => 'site/questions',
    'loot/lootjson' => 'loot/lootjson',
    'site/keysjson' => 'site/keysjson',
    'item/preview' => 'item/previewloot',
    'loot/quest-loot' => 'loot/questloot',
    'loot' => 'loot/mainloot',
    'loot/<action:[\w_\/-]+>/<name:[\w_\/-]+>' => 'loot/category',
    'loot/<name:[\w_\/-]+>' => 'loot/category',
    'development/after-master-push' => 'site/bitbucket-hook',
    [
        'class' => 'app\components\UrlComponent',
    ],
    [
        'class' => 'app\components\SkillsurlComponent',
    ],
    [
        'class' => 'app\components\CategoryurlComponent',
    ],
];