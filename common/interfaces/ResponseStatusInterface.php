<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.04.2023
 * Time: 21:43
 */

namespace app\common\interfaces;

/**
 * Интерфейс предоставляющий возможные коды ответа сервера, которые встречаются при обращениях к страницам
 *
 * Interface ResponseInterface
 */
interface ResponseStatusInterface
{
    /** @var int - Константа, код ответа 200 - все ок */
    public const OK_CODE = 200;

    /** @var int - Константа, код ответа сервера 301 - редирект, перемещено навсегда */
    public const REDIRECT_CODE = 301;

    /** @var int - Константа, код ответа сервера 302 - редирект, перемещено временно */
    public const REDIRECT_TEMPORARILY_CODE = 302;

    /** @var int - Константа, код ответа сервера 400 - некорретный запрос */
    public const BAD_REQUEST_CODE = 400;

    /** @var int - Константа, код ответа сервера 403 - доступ запрещен */
    public const FORBIDDEN_CODE = 403;

    /** @var int - Константа, код ответа 404 - страница не найдена */
    public const NOT_FOUND_CODE = 404;

    /** @var int - Константа, код ответа 500 - ошибка на стороне сервера */
    public const SERVER_ERROR_CODE = 500;
}