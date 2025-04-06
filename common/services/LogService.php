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
use yii\db\Exception;
use Yii;

/**
 * Сервис логирования ошибок приложения
 *
 * Class LogService
 * @package app\common\services
 */
final class LogService implements CommonServiceInterface
{
    /**
     * Метод создает новую запись об ошибках на сайте и сохраняет ее в таблицу логов ошибок
     *
     * @param string $url - URL адрес, где произошла проблема
     * @param string $type - Тип ошибки
     * @param string $description - Подробное описание ошибки
     * @param int $error_code - Код ошибки
     * @param bool $addToSentry - добавлять ли в Sentry запись об ошибке
     * @param bool $is_error - Если TRUE это ошибка, если FALSE - warning
     *
     * @return bool
     * @throws Exception
     */
    public static function saveErrorData(
        string $url,
        string $type,
        string $description,
        int $error_code = ResponseStatusInterface::SERVER_ERROR_CODE,
        bool $addToSentry = false,
        bool $is_error = false
    ): bool
    {
        /** Создаем новый объект модели ошибок и логов */
        $model = new ErrorLog();

        /** Сетапим атрибуты модели */
        $model->url = $_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] .  $url;
        $model->type = $type;
        $model->description = $description;
        $model->error_code = $error_code;

        /** Если надо, то логируем в Sentry сообщение */
        if ($addToSentry === true) {
            self::addSentryLog($description, $type, $error_code, $is_error);
        }

        /** Сохраняем новые данные */
        return $model->save();
    }

    /**
     * @param string $message - сообщение для логирования
     * @param string $type - Тип ошибки
     * @param int $err_code - Код ошибки WEB
     * @param bool $is_error - флаг, ошибка или нет
     * @return void
     */
    private static function addSentryLog(
        string $message,
        string $type,
        int $err_code = ResponseStatusInterface::SERVER_ERROR_CODE,
        bool $is_error = false
    ): void
    {
        if ($is_error === true) {
            Yii::error([
                'msg' => $message,
                'err_type' => $type,
                'err_code_from_log' => $err_code,
                'tags' => [
                    'LogService' => 'Called from PROD',
                ]
            ], 'app_catched_messages');
        } else {
            Yii::warning([
                'msg' => $message,
                'err_type' => $type,
                'err_code_from_log' => $err_code,
                'tags' => [
                    'LogService' => 'Called from PROD',
                ]
            ], 'app_catched_messages');
        }
    }
}