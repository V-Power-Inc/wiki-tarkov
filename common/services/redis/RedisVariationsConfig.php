<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.11.2023
 * Time: 13:03
 */

namespace app\common\services\redis;

use Yii;

/**
 * Класс в котором прописаны конфиги вариаций для сброса кеша
 * Тут приведены массивы для всех контроллеров, что используют кеширование
 *
 * Class RedisVariationsConfig
 * @package app\common\services\redis
 */
class RedisVariationsConfig
{
    /** @var string - Константа, GET параметр пагинации */
    const GET_PARAM_PAGE = 'page';

    /** @var string - Константа, рекламный кукис оверлея */
    const COOCKIE_OVERLAY = 'overlay';

    /** @var string - Константа, кукис темной темы (Если есть - значит у пользователя темная тема сайта) */
    const COOCKIE_DARK_THEME = 'dark-theme';

    /**
     * Конфиг вариаций кеширования для контроллеров (Используется большинством контроллеров)
     * Если будут исключения, они будут представлены в виде отдельных методов в текущем классе
     *
     * @return array
     */
    public static function getMainControllerVariations(): array
    {
        return [
            $_SERVER['SERVER_NAME'],
            Yii::$app->request->url,
            Yii::$app->response->statusCode,
            Yii::$app->request->get(static::GET_PARAM_PAGE),
            Yii::$app->request->cookies->get(static::COOCKIE_OVERLAY),
            Yii::$app->request->cookies->get(static::COOCKIE_DARK_THEME)
        ];
    }

    /**
     * Конфиг вариаций кеширования для контроллера карт (Дополнен вариацией с ajax параметрами)
     *
     * @return array
     */
    public static function getMapsControllerVariations(): array
    {
        return [
            $_SERVER['SERVER_NAME'],
            Yii::$app->request->url,
            Yii::$app->request->isAjax,
            Yii::$app->response->statusCode,
            Yii::$app->request->get(static::GET_PARAM_PAGE),
            Yii::$app->request->cookies->get(static::COOCKIE_OVERLAY),
            Yii::$app->request->cookies->get(static::COOCKIE_DARK_THEME)
        ];
    }
}