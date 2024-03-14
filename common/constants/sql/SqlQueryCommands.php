<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 14.03.2024
 * Time: 12:49
 */

namespace app\common\constants\sql;

use app\models\Bosses;

/**
 * Класс для определения в константах различных SQL запросов
 * (В приложении их не так много, потому решено таким образом сделать)
 *
 * Class SqlQueryCommands
 * @package app\common\constants\sql
 */
final class SqlQueryCommands
{
    /** @var string - Выбираем количество записей из таблицы категории */
    public const COUNT_FROM_CATEGORY = 'SELECT COUNT(*) FROM category';

    /** @var string - Выбираем максимальную дату создания из таблицы Боссов */
    public const MAX_BOSSES_DATE_CREATE = 'SELECT MAX('.Bosses::ATTR_DATE_CREATE.') FROM bosses';
}