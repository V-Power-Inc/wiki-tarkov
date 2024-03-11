<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 11.03.2024
 * Time: 12:50
 */

namespace app\common\constants\log;

/**
 * Класс с константами описаний различного типа ошибок для Лог-сервиса
 *
 * Class ErrorDesc
 * @package app\common\constants\log
 */
class ErrorDesc
{
    /** @var string - Константа, тип ошибки по получению данных из API */
    const TYPE_ERROR_API = 'API не вернул данные';

    /** @var string - Константа, описание ошибки по получению данных из API */
    const DESC_ERROR_API = 'file_get_contents вернул false во время запроса к API';

    /** @var string - Константа, тип ошибки, когда не попали не в один из кейсов при вызове метода обработки предметов API */
    const TYPE_SERVER_API_ERROR = 'proccessSearchItem - Не попали не в один из кейсов';

    /** @var string - Константа, описание ошибки, когда не попали не в один из кейсов при вызове метода обработки предметов API */
    const DESC_SERVER_API_ERROR = 'Не попали не в один из кейсов, что предусмотрены логикой';

    /** @var string - Константа, тип ошибки, когда пользователь пытался создать заявку на создание клана но не вышло */
    const TYPE_CLAN_SAVE_ERROR = 'Ошибка при сохранении нового клана';

    /** @var string - Константа, описание, когда пользователь пытался создать заявку на создание клана но не вышло */
    const DESC_CLAN_SAVE_ERROR = 'Непредвиденная ошибка при сохранении клана - кейс else';

    /** @var string - Константа, описание типа ошибки - из API прилетела новая локация */
    const TYPE_NEW_API_MAP = 'Неизвестная локация из API, нужно обработать';

    /** @var string - Константа, описание ошибки - из API прилетела новая локация */
    const DESC_NEW_API_MAP = 'Из API прилетела новая локация - ';

    /** @var string - Константа, описание типа ошибки - из API прилетел новый босс */
    const TYPE_NEW_API_BOSS = 'Неизвестный босс из API, нужно обработать';

    /** @var string - Константа, описание ошибки - из API прилетел новый босс */
    const DESC_NEW_API_BOSS = 'Из API прилетел новый босс - ';
}