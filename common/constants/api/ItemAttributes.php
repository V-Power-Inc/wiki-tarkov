<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.11.2023
 * Time: 14:02
 */

namespace app\common\constants\api;

/**
 * Класс с ключами атрибутов предметов из API, используется только во вьюхах
 * Нужен чтобы было проще переопределять атрибуты, если в будущем что-то изменится в API
 *
 * Используется вьюхой для отображения лута и атрибутов
 *
 * Class ItemAttributes
 * @package app\common\constants\api
 */
final class ItemAttributes
{
    /** @var string - Константа, ID предмета из API */
    public const ATTR_ITEM_ID = 'id';

    /** @var string - Константа, название предмета */
    public const ATTR_ITEM_NAME = 'name';

    /** @var string - Константа, описание предмета */
    public const ATTR_ITEM_DESCRIPTION = 'description';

    /** @var string - Константа, ссылка на изображение предмета */
    public const ATTR_ICON_LINK = 'iconLink';

    /** @var string - Константа, ссылка на изображение предмета высокого разрешения */
    public const ATTR_INSPECT_IMAGE_LINK = 'inspectImageLink';

    /** @var string - Константа, ключ массива до данных по категории предмета */
    public const ATTR_CATEGORY = 'category';

    /** @var string - Константа, название категории предмета */
    public const ATTR_CATEGORY_NAME = 'name';

    /** @var string - Константа, вес предмета */
    public const ATTR_ITEM_WEIGHT = 'weight';

    /** @var string - Константа, ключ массива до данных у кого можно купить */
    public const ATTR_BUY_FOR = 'buyFor';

    /** @var string - Константа, ключ массива до данных у кого можно продать */
    public const ATTR_SELL_FOR = 'sellFor';

    /** @var string - Константа, ключ массива до данных, за что можно выменять предмет */
    public const ATTR_BARTERS_FOR = 'bartersFor';

    /** @var string - Константа, ключ до массива о задачах, что должны быть выполнены (квесты) */
    public const ATTR_TASK_UNLOCK = 'taskUnlock';

    /** @var string - Ключ до данных, за какие квесты можно получить этот предмет */
    public const ATTR_RECIEVED_FOR_TASKS = 'receivedFromTasks';

    /** @var string - Константа, ключ массива до данных о торговце */
    public const ATTR_VENDOR = 'vendor';

    /** @var string - Константа, ключ до названия торговца */
    public const ATTR_VENDOR_NAME = 'name';

    /** @var string - Константа, вид валюты */
    public const ATTR_VENDOR_CURRENCY = 'currency';

    /** @var string - Константа, цена предмета у вендора */
    public const ATTR_VENDOR_PRICE = 'price';

    /** @var string - Константа, стоимость в рублях */
    public const ATTR_VENDOR_PRICE_RUB = 'priceRUB';

    /** @var string - Константа, ключ до данных о торговце */
    public const ATTR_TRADER = 'trader';

    /** @var string - Константа, ключ до данных об имени торговца */
    public const ATTR_TRADER_NAME = 'name';

    /** @var string - Константа, уровень торговца */
    public const ATTR_TRADER_LEVEL = 'level';

    /** @var string - Необходимые предметы для бартера */
    public const ATTR_REQUIRED_ITEMS = 'requiredItems';

    /** @var string - Количество предмета, необходимое для бартера */
    public const ATTR_COUNT = 'count';

    /** @var string - Ключ до данных о предмете в бартерах */
    public const ATTR_ITEM = 'item';
}