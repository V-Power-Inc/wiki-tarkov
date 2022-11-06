<?php
/** Подключаем конфиг с DotEnv с самого начала, чтобы в том числе пробросить переменные в инициализацию приложения ниже */
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../config/bootstrap.php';

// Это переменные окружения приложения, работают через DotEnv файл
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

/** Подрубаем основной конфиг */
$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();