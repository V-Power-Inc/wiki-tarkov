<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.10.2023
 * Time: 0:41
 */

namespace app\models\queries;

use app\models\ApiSearchLogs;
use yii\db\ActiveQuery;
use yii\db\Connection;

/**
 * Индивидуальный класс ActiveQuery для AR модели
 *
 * @template T of ApiSearchLogs|array = ApiSearchLogs
 * @extends ActiveQuery<T>
 *
 * Class ApiSearchLogsQuery
 * @package app\models\queries
 */
final class ApiSearchLogsQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @param Connection|null $db
     * @return T[]
     */
    public function all($db = null)
    {
        /** Поиск всех подходящих записей */
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @param Connection|null $db
     * @return T|null
     */
    public function one($db = null)
    {
        /** Поиск одной записи */
        return parent::one($db);
    }
}