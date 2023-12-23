<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.08.2022
 * Time: 21:16
 */

namespace app\common\services;

use app\models\Maps;
use yii\helpers\Json;

/**
 * Класс для работы с маркерами для интерактивных карт
 *
 * Class MarkersService
 * @package app\common\services
 */
final class MarkersService
{
    /**
     * Метод вытаскивает маркеры, по переданному значению названия карты
     * Возвращает Json
     *
     * @param string $map_title - название карты
     *
     * @return string
     */
    public static function takeMarkers(string $map_title): string
    {
        /** Переменная с маркерами для return'a */
        $markers = '';

        /** В свиче в зависимости от названия карты вернем нужный набор маркеров */
        switch ($map_title) {
            case 'zavod':
                $markers = Maps::takeZavodMarkers();
                break;
            case 'tamojnya':
                $markers = Maps::takeTamojnyaMarkers();
                break;
            case 'forest':
                $markers = Maps::takeForestMarkers();
                break;
            case 'bereg':
                $markers = Maps::takeBeregMarkers();
                break;
            case 'razvyazka':
                $markers = Maps::takeRazvyazkaMarkers();
                break;
        }

        /** Возвращает маркеры, приведенные к JSON виду */
        return Json::encode($markers);
    }
}