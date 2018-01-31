<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Admin',
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
            'roots' => [
                [
                    'baseUrl'=>'@web',
                    'basePath'=>'@webroot',
                    'path' => 'img/upload',
                    'name' => 'Upload'
                ],
            ],
//                'watermark' => [
//                    'source'         => __DIR__.'/logo.png', // Path to Water mark image
//                    'marginRight'    => 5,          // Margin right pixel
//                    'marginBottom'   => 5,          // Margin bottom pixel
//                    'quality'        => 95,         // JPEG image save quality
//                    'transparency'   => 70,         // Water mark image transparency ( other than PNG )
//                    'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
//                    'targetMinPixel' => 200         // Target image minimum pixel size
//                ]
        ]
    ],
    
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1hBkrFZrVWrw8sN25lzsC_f99y1waHDa',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Admins',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
           // 'enableStrictParsing' => false,
            'rules' => [
                '' => 'site/index',
                'admin/login' => 'admin/default/logout',
                'maps' => 'site/locations',
                'maps/zavod-location' => 'site/zavod',
                'maps/forest-location' => 'site/forest',
                'maps/tamojnya-location' => 'site/tamojnya',
                'quests-of-traders' => 'site/quests',
                'quests-of-traders/prapor-quests' => 'site/praporpage',
                'quests-of-traders/terapevt-quests' => 'site/terapevtpage',
                'quests-of-traders/skypchik-quests' => 'site/skypchikpage',
                'quests-of-traders/lyjnic-quests' => 'site/lyjnicpage',
                'quests-of-traders/mirotvorec-quests' => 'site/mirotvorecpage',
                'quests-of-traders/mehanik-quests' => 'site/mehanicpage',
                'keys' => 'site/keys',
                'news' => 'site/news',
                'loot' => 'loot/mainloot',
                'articles' => 'site/articles',
                'loot/<id:\d+>' => 'item/detailloot',
                'loot/<url:[\w_\/-]+>'=>'loot/category',
                
                [
                    'class' => 'app\components\UrlComponent',
                ],
            ],
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LcN1DUUAAAAAP5NlB9Xh2k6Bjhjd9TGD10XhMA5',
            'secret' => '6LcN1DUUAAAAAEBtk-iF1wqtdPOx5eo3-uzljni_',
        ],
    ],
    
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        // 'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // Доуступно с любого хоста
//        'allowedIPs' => ['127.0.0.1', '::1','*'],
    ];
}

return $config;
