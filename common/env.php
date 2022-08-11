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
?>