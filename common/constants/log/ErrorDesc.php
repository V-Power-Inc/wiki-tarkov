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
final class ErrorDesc
{
    /** @var string - Константа, тип ошибки по получению данных из API */
    public const TYPE_ERROR_API = 'API не вернул данные';

    /** @var string - Константа, описание ошибки по получению данных из API */
    public const DESC_ERROR_API = 'file_get_contents вернул false во время запроса к API';

    /** @var string - Константа, тип ошибки, когда не попали не в один из кейсов при вызове метода обработки предметов API */
    public const TYPE_SERVER_API_ERROR = 'proccessSearchItem - Не попали не в один из кейсов';

    /** @var string - Константа, описание ошибки, когда не попали не в один из кейсов при вызове метода обработки предметов API */
    public const DESC_SERVER_API_ERROR = 'Не попали не в один из кейсов, что предусмотрены логикой';

    /** @var string - Константа, тип ошибки, когда пользователь пытался создать заявку на создание клана но не вышло */
    public const TYPE_CLAN_SAVE_ERROR = 'Ошибка при сохранении нового клана';

    /** @var string - Константа, описание, когда пользователь пытался создать заявку на создание клана но не вышло */
    public const DESC_CLAN_SAVE_ERROR = 'Непредвиденная ошибка при сохранении клана - кейс else';

    /** @var string - Константа, описание типа ошибки - из API прилетела новая локация */
    public const TYPE_NEW_API_MAP = 'Неизвестная локация из API, нужно обработать';

    /** @var string - Константа, описание ошибки - из API прилетела новая локация */
    public const DESC_NEW_API_MAP = 'Из API прилетела новая локация - ';

    /** @var string - Константа, описание типа ошибки - из API прилетел новый босс */
    public const TYPE_NEW_API_BOSS = 'Неизвестный босс из API, нужно обработать';

    /** @var string - Константа, описание ошибки - из API прилетел новый босс */
    public const DESC_NEW_API_BOSS = 'Из API прилетел новый босс - ';

    /** @var string - Константа, описание типа ошибки - из API прилетел новый торговец */
    public const TYPE_NEW_API_TRADER = 'Неизвестный торговец из API, нужно обработать';

    /** @var string - Константа, описание ошибки - из API прилетел новый торговец */
    public const DESC_NEW_API_TRADER = 'Из API прилетел новый торговец - ';

    /** @var string - Константа, описание типа ошибки - Новое состояние квеста из API */
    public const TYPE_NEW_API_QUEST_STATE = 'Новое состояние квеста из API';

    /** @var string - Константа, описание ошибки - Новое состояние квеста из API */
    public const DESC_NEW_API_QUEST_STATE = 'Из API прилетело новое состояние квеста - ';

    /** @var string - Константа, описание типа ошибки - Новая фракция из API */
    public const TYPE_NEW_API_FACTION = 'Новая фракция из API';

    /** @var string - Константа, описание ошибки - Новая фракция из API */
    public const DESC_NEW_API_QUEST_FACTION = 'Из API прилетела новая фракция - ';

    /** @var string - Константа, описание ошибки - Невалидный JSON из API */
    public const TYPE_ERROR_JSON_ENCODE_API = 'Не смогли закодировать в JSON данные из API';

    /** @var string - Константа, когда URL предмета в API был изменен */
    public const TYPE_ERROR_WHILE_UPDATE_API_ITEM = 'Не был обновлен API предмета. Предмет был деактивирован.';

    /** @var string - Константа, описание ошибки - Невалидный JSON из API */
    public const DESC_ERROR_JSON_ENCODE_API = 'При получении новых предметов, не удалось их форматнуть в JSON для сохранения в БД';

    /** @var string - Константа, описание типа ошибки - Не смогли распарсить и посчитать количество свиты */
    public const TYPE_ERROR_ARRAY_BOSSES_PEOPLE = 'Ошибка при парсинге количества свиты - некорректный массив';

    /** @var string - Константа, описание ошибки - Не смогли распарсить и посчитать количество свиты */
    public const DESC_ERROR_ARRAY_BOSSES_PEOPLE = 'Вероятно у API изменился результат ответа';

    /** @var string @var string - Константа, тип ошибки, когда пользователь новым запросом к API не нашел релевантного лута */
    public const TYPE_EMPTY_API_SEARCH = 'Новый лут поисковым запросом в API не найден';

    /** @var string - Константа, описание ошибки - новый лут по новому пользовательскому запросу не был подгружен */
    public const DESC_EMPTY_API_SEARCH = 'При поиске лута пользователем - не были возвращены новые результаты. Новый лут не найден - флаг 0 для поискового запроса';

    /** @var string - Константа, описание ошибки URL предмета в API был изменен */
    public const DESC_ERROR_WHILE_UPDATE_API_ITEM = 'URL предмета в API изменился, предмет не был обновлен.';
}