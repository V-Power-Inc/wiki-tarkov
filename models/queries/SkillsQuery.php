<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.10.2023
 * Time: 23:24
 */

namespace app\models\queries;

use app\models\Skills;
use yii\db\ActiveQuery;
use yii\db\Connection;

/**
 * Индивидуальный класс ActiveQuery для AR модели
 *
 * @template T of Skills|array = Skills
 * @extends ActiveQuery<T>
 *
 * Class SkillsQuery
 * @package app\models\queries
 */
final class SkillsQuery extends ActiveQuery
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