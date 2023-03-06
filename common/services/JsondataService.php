<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 11.08.2022
 * Time: 21:50
 */

namespace app\common\services;

use app\models\Tasks;
use yii\db\Query;
use yii\helpers\Json;
use app\models\Category;
use app\models\Bosses;

/**
 * Сервис предназначенный для получения и передачи в контроллер необходимых
 * выборок данных в JSON формате
 *
 * Class JsondataService
 * @package app\common\services
 */
final class JsondataService
{
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
        $query = new Query;

        $query->select('name, mapgroup, preview, url')
            ->from('doorkeys')
            ->where('name LIKE "%' . $q . '%"')
            ->orWhere('keywords LIKE "%' . $q . '%"')
            ->andWhere(['active' => 1])
            ->orderBy('name')
            ->cache(3600);
        $command = $query->createCommand();
        $data = $command->queryAll();

        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {
            $out[] = ['value' => $d['name'], 'name' => $d['name'], 'preview' => $d['preview'], 'url' => $d['url'], 'mapgroup' => $d['mapgroup']];
        }
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
        $query = new Query;

        $query->select('title, shortdesc, preview, url, parentcat_id, search_words')
            ->from('items')
            ->where('title LIKE "%' . $q . '%"')
            ->orWhere('search_words LIKE "%' . $q . '%"')
            ->andWhere(['active' => 1])
            ->orderBy('title')
            ->cache(3600);
        $command = $query->createCommand();
        $data = $command->queryAll();

        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {
            $parencat = Category::find()->where(['id' => $d['parentcat_id']])->cache(3600)->one();
            $out[] = ['value' => $d['title'], 'title' => $d['title'], 'parentcat_id' => $parencat->title, 'shortdesc' => $d['shortdesc'], 'preview' => $d['preview'], 'url' => $d['url']];
        }
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
        $query = new Query;

        $query->select('words')
            ->from('api_search_logs')
            ->where('words LIKE "%' . $q . '%"')
            ->andWhere(['flag' => 1])
            ->groupBy('words')
            ->orderBy('date_create')
            ->cache(3600);
        $command = $query->createCommand();
        $data = $command->queryAll();

        $out = [];

        /** Цикл составления готовых данных по запросу пользователя в поиске **/
        foreach ($data as $d) {
            $out[] = ['value' => $d['words'], 'title' => $d['words']];
        }
        return Json::encode($out);
    }

    /**
     * Метод по параметру URL адрес возвращает набор данных нужной карты из таблицы Bosses
     *
     * @param string $url
     * @return mixed
     */
    public static function getBossData(string $url)
    {
        return Json::decode(Bosses::getBossData($url));
    }
}