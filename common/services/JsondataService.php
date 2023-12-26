<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 11.08.2022
 * Time: 21:50
 */

namespace app\common\services;

use app\models\ApiSearchLogs;
use app\models\Clans;
use app\models\Doorkeys;
use app\models\Items;
use yii\db\Query;
use yii\helpers\Json;
use app\models\Category;
use app\models\Bosses;
use Yii;

/**
 * Сервис предназначенный для получения и передачи в контроллер необходимых
 * выборок данных в JSON формате
 *
 * Class JsondataService
 * @package app\common\services
 */
final class JsondataService
{
    /** @var string - Ключ массива результирующих значений для массива данных */
    const ATTR_VALUE = 'value';

    /** @var string - Ключ массива title для результирующих данных массивов */
    const ATTR_TITLE = 'title';

    /**
     * Метод вытаскивает необходимые названия ключей по параметру
     * который приходит в виде строки
     *
     * @param string|null $q - поисковый запрос
     * @return string
     * @throws \yii\db\Exception
     */
    public static function getKeysJson(string $q = null): string
    {
        /** Объект запроса к БД */
        $query = new Query;

        /** Выбираем нужные данные с кешируемым запросом */
        $query->select([Doorkeys::ATTR_NAME, Doorkeys::ATTR_MAPGROUP, Doorkeys::ATTR_PREVIEW, Doorkeys::ATTR_URL])
            ->from(Doorkeys::tableName())
            ->where(Doorkeys::ATTR_NAME . ' LIKE "%' . $q . '%"')
            ->orWhere(Doorkeys::ATTR_KEYWORDS . ' LIKE "%' . $q . '%"')
            ->andWhere([Doorkeys::ATTR_ACTIVE => 1])
            ->orderBy(Doorkeys::ATTR_NAME)
            ->cache(Yii::$app->params['cacheTime']['one_hour']);

        /** Создаем SQL команду */
        $command = $query->createCommand();

        /** Выбираем всех подходящие под запрос данные */
        $data = $command->queryAll();

        /** Массив для результатов */
        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {

            /** Добавляем в итоговый массив нужные данные */
            $out[] = [
                static::ATTR_VALUE      => $d[Doorkeys::ATTR_NAME],
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
     * @throws \yii\db\Exception
     */
    public static function getLootJson(string $q = null): string
    {
        /** Объект запроса к БД */
        $query = new Query;

        /** Выбираем нужные данные с кешируемым запросом */
        $query->select([Items::ATTR_TITLE, Items::ATTR_SHORTDESC, Items::ATTR_PREVIEW, Items::ATTR_URL, Items::ATTR_PARENTCAT_ID, Items::ATTR_SEARCH_WORDS])
            ->from(Items::tableName())
            ->where(Items::ATTR_TITLE . ' LIKE "%' . $q . '%"')
            ->orWhere(Items::ATTR_SEARCH_WORDS . ' LIKE "%' . $q . '%"')
            ->andWhere([Items::ATTR_ACTIVE => Items::TRUE])
            ->orderBy(Items::ATTR_TITLE)
            ->cache(Yii::$app->params['cacheTime']['one_hour']);

        /** Выбираем нужные данные с кешируемым запросом */
        $command = $query->createCommand();

        /** Выбираем всех подходящие под запрос данные */
        $data = $command->queryAll();

        /** Массив для результатов */
        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {

            /** Получаем объект родительской категории предмета */
            $parencat = Category::find()
                ->where([Category::ATTR_ID => $d[Items::ATTR_PARENTCAT_ID]])
                ->cache(Yii::$app->params['cacheTime']['one_hour'])
                ->one();

            /** Добавляем в итоговый массив нужные данные */
            $out[] = [
                static::ATTR_VALUE       => $d[Items::ATTR_TITLE],
                static::ATTR_TITLE       => $d[Items::ATTR_TITLE],
                Items::ATTR_PARENTCAT_ID => $parencat->title,
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
     * @throws \yii\db\Exception
     */
    public static function getSearchItem(string $q = null): string
    {
        /** Объект запроса к БД */
        $query = new Query;

        /** Выбираем нужные данные с кешируемым запросом */
        $query->select(ApiSearchLogs::ATTR_WORDS)
            ->from(ApiSearchLogs::tableName())
            ->where(ApiSearchLogs::ATTR_WORDS .' LIKE "%' . $q . '%"')
            ->andWhere([ApiSearchLogs::ATTR_FLAG => ApiSearchLogs::TRUE])
            ->groupBy(ApiSearchLogs::ATTR_WORDS)
            ->orderBy(ApiSearchLogs::ATTR_DATE_CREATE)
            ->cache(Yii::$app->params['cacheTime']['one_hour']);

        /** Выбираем нужные данные с кешируемым запросом */
        $command = $query->createCommand();

        /** Выбираем всех подходящие под запрос данные */
        $data = $command->queryAll();

        /** Массив для результатов */
        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {

            /** Добавляем в итоговый массив нужные данные */
            $out[] = [
                static::ATTR_VALUE => $d[ApiSearchLogs::ATTR_WORDS],
                static::ATTR_TITLE => $d[ApiSearchLogs::ATTR_WORDS]
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
     * @throws \yii\db\Exception
     */
    public static function getClansList(string $q = null): string
    {
        /** Преподгатавливаем переменную для запроса к БД */
        $query = new Query;

        /** Определяем запрос и ищем клан по названию */
        $query->select([Clans::ATTR_TITLE, Clans::ATTR_DESCRIPTION, Clans::ATTR_PREVIEW, Clans::ATTR_LINK, Clans::ATTR_DATE_CREATE])
            ->from(Clans::tableName())
            ->where(Clans::ATTR_TITLE . ' LIKE "%' . $q . '%"')
            ->andWhere([Clans::ATTR_MODERATED => Clans::TRUE])
            ->orderBy( Clans::ATTR_DATE_CREATE .' DESC')
            ->limit(30)
            ->cache(Yii::$app->params['cacheTime']['one_minute']);

        /** Определяем команду и выполняем запрос */
        $command = $query->createCommand();

        /** Указываем выбрать все нужные записи */
        $data = $command->queryAll();

        /** Массив для резултирующих данных */
        $out = [];

        /** В цикле наполняем массив с результирующими данными - в нужном формате **/
        foreach ($data as $d) {

            /** Добавляем в итоговый массив нужные данные */
            $out[] = [
                static::ATTR_VALUE      => $d[Clans::ATTR_TITLE],
                static::ATTR_TITLE      => $d[Clans::ATTR_TITLE],
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