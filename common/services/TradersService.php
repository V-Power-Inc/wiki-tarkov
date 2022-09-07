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
    public function takeQuests(string $trader_name): array
    {
        $trader = null;

        switch ($trader_name) {
            case 'mehanic':
                $mehanic = Mehanic::takeQuestsMehanic();
                return $mehanic;
            case 'skypshik':
                $skypshik = Skypshik::takeQuestsSkypshik();
                return $skypshik;
            case 'lyjnic':
                $lyjnic = Lyjnic::takeQuestsLyjnic();
                return $lyjnic;
            case 'terapevt':
                $terapevt = Terapevt::takeQuestsTerapevt();
                return $terapevt;
            case 'prapor':
                $prapor = Prapor::takeQuestsPrapor();
                return $prapor;
            case 'mirotvorec':
                $mirotvorec = Mirotvorec::takeQuestsMirotvorec();
                return $mirotvorec;
            case 'baraholshik':
                $baraholshik = Baraholshik::takeQuestsBaraholshik();
                return $baraholshik;
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }

}