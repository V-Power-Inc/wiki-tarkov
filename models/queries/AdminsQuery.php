<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.10.2023
 * Time: 0:16
 */

namespace app\models\queries;

use app\models\Admins;
use yii\db\ActiveQuery;
use yii\db\Connection;

/**
 * Индивидуальный класс ActiveQuery для AR модели
 *
 * @template T of Admins|array = Admins
 * @extends ActiveQuery<T>
 *
 * Class AdminsQuery
 * @package app\models\queries
 */
final class AdminsQuery extends ActiveQuery
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

    /**
     * Метод для выбора пользователей, которые не являются забаненными
     *
     * @return $this
     */
    public function notBanned(): AdminsQuery
    {
        return $this->andWhere([Admins::TABLE_NAME . '.' . Admins::ATTR_BANNED => Admins::FALSE]);
    }
}