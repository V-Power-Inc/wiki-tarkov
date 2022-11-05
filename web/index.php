<?php

/** todo: При перелючении на Dev - это не работает как надо, стоит с этим разобраться **/
/** Подключаем конфиг с DotEnv с самого начала, чтобы в том числе пробросить переменные в инициализацию приложения ниже */
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../config/bootstrap.php';

// Это переменные окружения приложения, работают через DotEnv файл
defined('YII_DEBUG') or define('YII_DEBUG', filter_var($_ENV['DEBUG_STATUS'], FILTER_VALIDATE_BOOLEAN));
defined('YII_ENV') or define('YII_ENV', $_ENV['ENVIRONMENT']);

/** Подрубаем основной конфиг */
$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();