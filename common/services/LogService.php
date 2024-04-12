<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 11.03.2024
 * Time: 12:37
 */

namespace app\common\services;

use app\common\interfaces\ResponseStatusInterface;
use app\models\ErrorLog;

/**
 * Сервис логирования ошибок приложения
 *
 * Class LogService
 * @package app\common\services
 */
final class LogService
{
    /**
     * Метод создает новую запись об ошибках на сайте и сохраняет ее в таблицу логов ошибок
     *
     * @param string $url - URL адрес, где произошла проблема
     * @param string $type - Тип ошибки
     * @param string $description - Подробное описание ошибки
     * @param int $error_code - Код ошибки
     *
     * @return bool
     */
    public static function saveErrorData(string $url, string $type, string $description, int $error_code = ResponseStatusInterface::SERVER_ERROR_CODE): bool
    {
        /** Создаем новый объект модели ошибок и логов */
        $model = new ErrorLog();

        /** Сетапим атрибуты модели */
        $model->url = $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] .  $url;
        $model->type = $type;
        $model->description = $description;
        $model->error_code = $error_code;

        /** Сохраняем новые данные */
        return $model->save();
    }
}