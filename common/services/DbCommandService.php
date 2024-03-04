<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 04.03.2024
 * Time: 15:51
 */

namespace app\common\services;

use yii\db\DataReader;
use yii\db\Exception;
use yii\db\Query;

/**
 * Сервис для генерации SQL комманд через createCommand Yii
 *
 * Class DbCommandService
 * @package app\common\services
 */
final class DbCommandService
{
    /**
     * Метод формирует команду из объекта Query - в данном случае для выборки всех записей соответсвующих запросу
     *
     * @param Query $query - Объект DB Query
     *
     * @return array|DataReader
     * @throws Exception
     */
    public static function createCommandQueryAll(Query $query)
    {
        /** Создаем SQL команду из запроса */
        $command = $query->createCommand();

        /** Указываем ее выполнить */
        return $command->queryAll();
    }
}