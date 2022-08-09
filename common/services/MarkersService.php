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
 */
class MarkersService
{
    /** @var int - константа кеширования в секундах (1 час) */
    const ONE_HOUR = 3600;

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
                    $markers = Zavod::find()->asArray()->andWhere([Zavod::ATTR_ENABLED => Zavod::TRUE])->cache(self::ONE_HOUR)->all();
                    break;
                case 'tamojnya':
                    $markers = Tamojnya::find()->asArray()->andWhere([Tamojnya::ATTR_ENABLED => Tamojnya::TRUE])->cache(self::ONE_HOUR)->all();
                    break;
                case 'forest':
                    $markers = Forest::find()->asArray()->andWhere([Forest::ATTR_ENABLED => Forest::TRUE])->cache(self::ONE_HOUR)->all();
                    break;
                case 'bereg':
                    $markers = Bereg::find()->asArray()->andWhere([Bereg::ATTR_ENABLED => Bereg::TRUE])->cache(self::ONE_HOUR)->all();
                    break;
                case 'razvyazka':
                    $markers = Razvyazka::find()->asArray()->andWhere([Razvyazka::ATTR_ENABLED => Razvyazka::TRUE])->cache(self::ONE_HOUR)->all();
                    break;
            }

            return Json::encode($markers);
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }
}