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

    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1hBkrFZrVWrw8sN25lzsC_f99y1waHDa',
        ],
        'assetManager' => [
            'linkAssets' => true
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
        ],
        'redis' => [
            'class'    => 'yii\redis\Connection',
            'hostname' => $_ENV['REDIS_HOST'],
            'port' => 6379,
            'database' => 0,
        ],
        'user' => [
            'identityClass' => 'app\models\Admins',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
            'class' => 'app\common\exceptions\AppErrorHandler'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [ // Если нет акка в Sentry, можно дефолтный Yii2 лог оставить
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'notamedia\sentry\SentryTarget',
                    'dsn' => $_ENV['SENTRY_DSN'],
                    'levels' => ['error', 'warning'],
                    // Write the context information (the default is true):
                    'context' => true,
                    // Additional options for `Sentry\init`:
                    // 'clientOptions' => ['release' => 'my-project-name@2.3.12']
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require __DIR__ . '/routes.php'
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

/** Если DotEnv стоит Dev - тогда даем возможность использовать дебаг */
if ($_ENV['ENVIRONMENT'] == 'dev') {
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
        // Доступно с любого хоста
        // 'allowedIPs' => ['127.0.0.1', '::1','*'],
    ];
}

return $config;