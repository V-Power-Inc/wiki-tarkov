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
use yii\web\HttpException;
use yii\helpers\Json;
use Yii;

/**
 * Класс для работы с маркерами для интерактивных карта
 *
 * Class MarkersService
 * @package app\common\services
 */
final class MarkersService
{
    /**
     * Метод вытаскивает маркеры, по переданному значению
     *
     * @param string $map_title - название карты
     * @return string
     * @throws HttpException
     */
    public static function takeMarkers(string $map_title): string
    {
        if (Yii::$app->request->isAjax) {

            $markers = '';

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

            return Json::encode($markers);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }
}