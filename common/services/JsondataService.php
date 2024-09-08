<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 11.08.2022
 * Time: 21:50
 */

namespace app\common\services;

use app\models\{ApiSearchLogs, Clans, Doorkeys, Items, Category, Bosses};
use yii\helpers\Json;
use yii\db\Exception;

/**
 * Сервис предназначенный для получения и передачи в контроллер необходимых выборок данных в JSON формате
 *
 * Class JsondataService
 * @package app\common\services
 */
final class JsondataService
{
    /** @var string - Ключ массива результирующих значений для массива данных */
    private const ATTR_VALUE = 'value';

    /** @var string - Ключ массива title для результирующих данных массивов */
    private const ATTR_TITLE = 'title';

    /**
     * Метод вытаскивает необходимые названия ключей по параметру
     * который приходит в виде строки
     *
     * @param string|null $q - поисковый запрос
     * @return string
     *
     * @throws Exception
     */
    public static function getKeysJson(string $q = null): string
    {
        /** Выбираем всех подходящие под запрос данные */
        $data = DbCommandService::createCommandQueryAll(Doorkeys::getKeysForSelectSearch($q));

        /** Массив для результатов */
        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {

            /** Добавляем в итоговый массив нужные данные */
            $out[] = [
                self::ATTR_VALUE        => $d[Doorkeys::ATTR_NAME],
                Doorkeys::ATTR_NAME     => $d[Doorkeys::ATTR_NAME],
                Doorkeys::ATTR_PREVIEW  => $d[Doorkeys::ATTR_PREVIEW],
                Doorkeys::ATTR_URL      => $d[Doorkeys::ATTR_URL],
                Doorkeys::ATTR_MAPGROUP => $d[Doorkeys::ATTR_MAPGROUP]
            ];
        }

        /** Возвращаем массив закодированный в Json */
        return Json::encode($out);
    }

    /**
     * Метод вытаскивает необходимые названия лута
     * и связанную категорию по параметру который приходит в виде строки
     *
     * @param string|null $q
     * @return string
     *
     * @throws Exception
     */
    public static function getLootJson(string $q = null): string
    {
        /** Выбираем всех подходящие под запрос данные */
        $data = DbCommandService::createCommandQueryAll(Items::getItemsForSelectSearch($q));

        /** Массив для результатов */
        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {

            /** Получаем объект родительской категории предмета */
            $parentcat = Category::getCategoryById($d[Items::ATTR_PARENTCAT_ID]);

            /** Добавляем в итоговый массив нужные данные */
            $out[] = [
                self::ATTR_VALUE         => $d[Items::ATTR_TITLE],
                self::ATTR_TITLE         => $d[Items::ATTR_TITLE],
                Items::ATTR_PARENTCAT_ID => $parentcat ? $parentcat->title : 'Категория не определена',
                Items::ATTR_SHORTDESC    => $d[Items::ATTR_SHORTDESC],
                Items::ATTR_PREVIEW      => $d[Items::ATTR_PREVIEW],
                Items::ATTR_URL          => $d[Items::ATTR_URL]
            ];
        }

        /** Возвращаем массив закодированный в Json */
        return Json::encode($out);
    }

    /**
     * Метод осуществляет поиск слов в таблице поисковых логов API, для того чтобы вывести пользователям подсказки
     * которые точно приведут к нахождению искомых предметов
     *
     * @param string|null $q - поисковый запрос
     * @return string
     *
     * @throws Exception
     */
    public static function getSearchApiLogItem(string $q = null): string
    {
        /** Выбираем всех подходящие под запрос данные */
        $data = DbCommandService::createCommandQueryAll(ApiSearchLogs::getSearchWordsForSelectSearch($q));

        /** Массив для результатов */
        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {

            /** Добавляем в итоговый массив нужные данные */
            $out[] = [
                self::ATTR_VALUE => $d[ApiSearchLogs::ATTR_WORDS],
                self::ATTR_TITLE => $d[ApiSearchLogs::ATTR_WORDS]
            ];
        }

        /** Возвращаем конечный массив закодированным в JSON */
        return Json::encode($out);
    }

    /**
     * Метод осуществляет поиск кланов по таблице clans и возвращает результаты в виде Json
     *
     * @param string|null $q - поисковый запрос
     * @return string
     * @throws Exception
     */
    public static function getClansList(string $q = null): string
    {
        /** Выбираем всех подходящие под запрос данные */
        $data = DbCommandService::createCommandQueryAll(Clans::getClansForSelectSearch($q));

        /** Массив для резултирующих данных */
        $out = [];

        /** В цикле наполняем массив с результирующими данными - в нужном формате **/
        foreach ($data as $d) {

            /** Добавляем в итоговый массив нужные данные */
            $out[] = [
                self::ATTR_VALUE        => $d[Clans::ATTR_TITLE],
                self::ATTR_TITLE        => $d[Clans::ATTR_TITLE],
                Clans::ATTR_DESCRIPTION => $d[Clans::ATTR_DESCRIPTION],
                Clans::ATTR_PREVIEW     => $d[Clans::ATTR_PREVIEW],
                Clans::ATTR_LINK        => $d[Clans::ATTR_LINK],
                Clans::ATTR_DATE_CREATE => $d[Clans::ATTR_DATE_CREATE]
            ];
        }

        /** Возвращаем результирующий массив в формате Json */
        return Json::encode($out);
    }

    /**
     * Метод по параметру URL адрес возвращает набор данных нужной карты из таблицы Bosses
     * Декодирует данные из Json
     *
     * @param string $url - URL локации
     * @return mixed
     */
    public static function getBossData(string $url)
    {
        return Json::decode(Bosses::getBossData($url));
    }
}