<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 18:21
 * @repo https://github.com/vlucas/phpdotenv
 */

/** Объект для работы с переменными окружения */
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));

/** Грузим переменные окружения */
$dotenv->load();

/** Эти глобальные переменные должны быть определены в .env, иначе будет 500-сотить
 * Ключи рекапчи не включал сюда, при желании можно капчу снести полнстью - смотреть пример в .env.example
 */
$dotenv->required([
    'DEBUG_STATUS',
    'ENVIRONMENT',
    'DB_DSN',
    'DB_NAME',
    'DB_USER',
    'DB_PASSWORD',
    'DB_CHARSET',
    'DB_TEST_DSN',
    'DB_TEST_NAME',
    'DB_TEST_USER',
    'DB_TEST_PASSWORD',
    'DB_TEST_CHARSET',
    'DOMAIN_PROTOCOL',
    'DOMAIN',
    'REDIS_HOST'
]);
?>