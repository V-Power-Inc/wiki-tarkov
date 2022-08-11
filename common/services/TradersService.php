<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 10.08.2022
 * Time: 12:38
 */

namespace app\common\services;

use app\models\Mehanic;
use app\models\Skypshik;
use app\models\Lyjnic;
use app\models\Terapevt;
use app\models\Prapor;
use app\models\Mirotvorec;
use app\models\Baraholshik;
use yii\web\HttpException;

/**
 * Класс для работы с сущностями торговцев, включая квесты
 *
 * Class TradersService
 * @package app\common\services
 */
final class TradersService
{
    /**
     * Метод вытаскивает квесты торговца по его имени
     *
     * @param string $trader_name
     * @return array
     * @throws HttpException
     */
    public static function takeQuests(string $trader_name): array
    {
        $trader = null;

        switch ($trader_name) {
            case 'mehanic':
                $trader = Mehanic::takeQuests();
                break;
            case 'skypshik':
                $trader = Skypshik::takeQuests();
                break;
            case 'lyjnic':
                $trader = Lyjnic::takeQuests();
                break;
            case 'terapevt':
                $trader = Terapevt::takeQuests();
                break;
            case 'prapor':
                $trader = Prapor::takeQuests();
                break;
            case 'mirotvorec':
                $trader = Mirotvorec::takeQuests();
                break;
            case 'baraholshik':
                $trader = Baraholshik::takeQuests();
                break;
        }

        if ($trader) {
            return $trader;
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

}