<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.10.2023
 * Time: 0:41
 */

namespace app\models\queries;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Индивидуальный класс ActiveQuery для AR модели
 *
 * Class ApiSearchLogsQuery
 * @package app\models\queries
 */
class ApiSearchLogsQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @param null $db
     * @return array|ActiveRecord[]
     */
    public function all($db = null)
    {
        /** Поиск всех подходящих записей */
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @param null $db
     * @return array|ActiveRecord|null
     */
    public function one($db = null)
    {
        /** Поиск одной записи */
        return parent::one($db);
    }
}