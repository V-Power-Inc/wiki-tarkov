<?php
/** Конфиг для работы с тестированием */
return [
    'class' => 'yii\db\Connection',
    'dsn' => $_ENV['DB_TEST_DSN'],
    'username' => $_ENV['DB_TEST_USER'],
    'password' => $_ENV['DB_TEST_PASSWORD'],
    'charset' => $_ENV['DB_TEST_CHARSET'],
];
