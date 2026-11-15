<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require_once __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

Yii::setAlias('@app', __DIR__);

Dotenv\Dotenv::createImmutable(__DIR__, '.env.example')->load();
