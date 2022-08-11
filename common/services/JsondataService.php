<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 11.08.2022
 * Time: 21:50
 */

namespace app\common\services;

use yii\db\Query;
use yii\helpers\Json;

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
     * // todo На проде надо протестить, хз как себя это дело поведет при большом кол-ве посетителей
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



}