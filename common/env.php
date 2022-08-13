<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 18:21
 * @repo https://github.com/vlucas/phpdotenv
 */

/**
 * Load application environment from .env file
 */
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));


$dotenv->load();

/**
 * Эти глобальные переменные должны быть определены в .env, иначе будет 500-сотить
 */
$dotenv->required([
    'DB_DSN',
    'DB_NAME',
    'DB_USER',
    'DB_PASSWORD',
    'DB_CHARSET',
    'DOMAIN_PROTOCOL',
    'DOMAIN'
]);
?>