<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.11.2023
 * Time: 13:24
 */

namespace app\common\constants\api;

/**
 * Класс с ключами массива из API - босс
 * Нужен чтобы было проще переопределять атрибуты, если в будущем что-то изменится в API
 *
 * Используется вьюхой для отображения боссов и их атрибутов
 *
 * Class BossAttributes
 * @package app\common\constants\api
 */
final class BossAttributes
{
    /** @var string - Константа, имя босса */
    public const ATTR_NAME = 'name';

    /** @var string - Константа, шанс спавна */
    public const ATTR_SPAWN_CHANCE = 'spawnChance';

    /** @var string - Константа, локации спавна */
    public const ATTR_SPAWN_LOCATIONS = 'spawnLocations';

    /** @var string - Константа, есть ли у босса сопровождение */
    public const ATTR_ESCORTS = 'escorts';

    /** @var string - Константа, триггер спавна */
    public const ATTR_SPAWN_TRIGGER = 'spawnTrigger';
}