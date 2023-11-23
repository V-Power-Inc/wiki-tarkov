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
use yii\db\ActiveRecord;

/**
 * Индивидуальный класс ActiveQuery для AR модели
 *
 * Class AdminsQuery
 * @package app\models\queries
 */
class AdminsQuery extends ActiveQuery
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

    /**
     * Метод для выбора пользователей, которые не являются забаненными
     *
     * @return AdminsQuery
     */
    public function notBanned(): AdminsQuery
    {
        return $this->andWhere([Admins::TABLE_NAME . '.' . Admins::ATTR_BANNED => Admins::FALSE]);
    }
}