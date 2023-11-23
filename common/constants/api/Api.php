<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.11.2023
 * Time: 13:37
 */

namespace app\common\constants\api;

/**
 * Класс с описанием ключей массивов и прочих констант, которые использует Api в процессе работе
 * Этот функционал общий для Api боссов и Api справочника лута
 *
 * Сюда обращаемся только из контроллеров и классов (Для вьюх используются другие классы атрибутов)
 *
 * Class Api
 * @package app\common\constants\api
 */
final class Api
{
    /** @var string - Константа, ключ до массива с данными от API (Общий для всех данных, что возвращает API) */
    const ATTR_DATA = 'data';

    /** @var string - Константа, ключ до массив с данными о луте от API (Обработка данных о луте) */
    const ATTR_ITEMS = 'items';

    /** @var string - Константа, ключ до массива с данными о квестах от API (Обработка данных о квестах) */
    const ATTR_TASKS = 'tasks';

    /** @var string - Константа, ключ до массива карт на которых обитают боссы (Обработка данных о боссах) */
    const ATTR_MAPS = 'maps';

    /** @var string - Константа, ключ до названия локации из API (Обработка данных о боссах) */
    const ATTR_MAP_NAME = 'name';

    /** @var string - Константа, ключ до массива боссов из API (Обработка данных о боссах) */
    const ATTR_BOSSES = 'bosses';

    /** @var string - Константа, ключ до название предмета из API (Обработка данных о луте) */
    const ATTR_ITEM_NAME = 'name';

    /** @var string - Константа, ключ до нормализованного названия предмета из API (Обработка данных о луте) */
    const ATTR_NORMALIZED_ITEM_NAME = 'normalizedName';

    /** @var string - Констнта, ID предмета для его обновления в БД с помощью API (Обработка данных о луте) */
    const ATTR_ITEM_ID = 'id';
}