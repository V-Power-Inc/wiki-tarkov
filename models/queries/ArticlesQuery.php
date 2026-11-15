<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.10.2023
 * Time: 0:43
 */

namespace app\models\queries;

use app\models\Articles;
use yii\db\ActiveQuery;
use yii\db\Connection;

/**
 * Индивидуальный класс ActiveQuery для AR модели
 *
 * @template T of Articles|array = Articles
 * @extends ActiveQuery<T>
 *
 * Class ArticlesQuery
 * @package app\models\queries
 */
final class ArticlesQuery extends ActiveQuery
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