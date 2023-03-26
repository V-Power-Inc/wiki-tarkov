<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 09.08.2022
 * Time: 21:16
 */

namespace app\common\services;

use app\models\Razvyazka;
use app\models\Zavod;
use app\models\Forest;
use app\models\Tamojnya;
use app\models\Bereg;
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
     * Метод вытаскивает маркеры, по переданному значению
     *
     * @param string $map_title - название карты (Совпадает с названием таблицы)
     * @return string
     */
    public static function takeMarkers(string $map_title): string
    {
        /** Переменная с маркерами для return'a */
        $markers = '';

        /** В свиче в зависимости от названия карты вернем нужный набор маркеров */
        switch ($map_title) {
            case 'zavod':
                $markers = Zavod::takeMarkers();
                break;
            case 'tamojnya':
                $markers = Tamojnya::takeMarkers();
                break;
            case 'forest':
                $markers = Forest::takeMarkers();
                break;
            case 'bereg':
                $markers = Bereg::takeMarkers();
                break;
            case 'razvyazka':
                $markers = Razvyazka::takeMarkers();
                break;
        }

        /** Возвращает маркеры, приведенные к JSON виду */
        return Json::encode($markers);
    }
}