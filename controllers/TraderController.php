<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 10.08.2022
 * Time: 22:23
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\models\Mehanic;
use app\models\Skypshik;
use app\models\Lyjnic;
use app\models\Terapevt;
use app\models\Prapor;
use app\models\Mirotvorec;
use app\models\Baraholshik;
use app\models\Barters;
use app\models\Traders;
use app\common\services\TradersService;
use yii\web\HttpException;
use Yii;

/**
 * Это контроллер торговцев и связанных с ними действий
 *
 * Class TraderController
 * @package app\controllers
 */
class TraderController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_QUESTS                 = 'quests';
    const ACTION_TRADERSDETAIL          = 'tradersdetail';
    const ACTION_PRAPORPAGE             = 'praporpage';
    const ACTION_TERAPEVTPAGE           = 'terapevtpage';
    const ACTION_SKYPCHIKPAGE           = 'skypchikpage';
    const ACTION_LYJNICPAGE             = 'lyjnicpage';
    const ACTION_MIROTVORECPAGE         = 'mirotvorecpage';
    const ACTION_MEHANICPAGE            = 'mehanicpage';
    const ACTION_BARAHOLSHIKPAGE        = 'baraholshikpage';
    const ACTION_BARTERS_PREVIEW        = 'barterspreview';
    const ACTION_PREVIEWTRADER          = 'previewtrader';

    /** CSRF валидация POST запросов методов этого контроллера включена по умолачнию */
    public $enableCsrfValidation;

    /**
     * Рендер страницы квестов Прапора
     *
     * @return string
     * @throws HttpException
     */
    public function actionPraporpage(): string
    {
        return $this->render('prapor-quests', ['prapor'=> TradersService::takeQuests(Prapor::tableName())]);
    }

    /**
     * Рендер страницы квестов Терапевта
     *
     * @return string
     * @throws HttpException
     */
    public function actionTerapevtpage(): string
    {
        return $this->render('terapevt-quests', ['terapevt'=>TradersService::takeQuests(Terapevt::tableName())]);
    }

    /**
     * Рендер страницы квестов Скупщика
     *
     * @return string
     * @throws HttpException
     */
    public function actionSkypchikpage(): string
    {
        return $this->render('skypshik-quests', ['skypshik'=>TradersService::takeQuests(Skypshik::tableName())]);
    }

    /**
     * Рендер страницы квестов Лыжника
     *
     * @return string
     * @throws HttpException
     */
    public function actionLyjnicpage(): string
    {
        return $this->render('lyjnic-quests', ['lyjnic'=>TradersService::takeQuests(Lyjnic::tableName())]);
    }

    /**
     * Рендер страницы квестов Миротворца
     *
     * @return string
     * @throws HttpException
     */
    public function actionMirotvorecpage(): string
    {
        return $this->render('mirotvorec-quests', ['mirotvorec'=>TradersService::takeQuests(Mirotvorec::tableName())]);
    }

    /**
     * Рендер страницы квестов Механика
     *
     * @return string
     * @throws HttpException
     */
    public function actionMehanicpage(): string
    {
        return $this->render('mehanic-quests', ['mehanic'=>TradersService::takeQuests(Mehanic::tableName())]);
    }

    /**
     * Рендер страницы квестов Барахольщика
     *
     * @return string
     * @throws HttpException
     */
    public function actionBaraholshikpage(): string
    {
        return $this->render('baraholshik-quests', ['baraholshik'=>TradersService::takeQuests(Baraholshik::tableName())]);
    }

    /**
     * Рендер главной страницы с квестами
     *
     * @return string
     */
    public function actionQuests(): string
    {
        return $this->render('quests-main', ['traders' => Traders::takeTraders()]);
    }

    /**
     * Рендер детальной страницы торговца
     *
     * @param $id - url адрес торговца
     * @return string
     * @throws HttpException
     */
    public function actionTradersdetail($id): string
    {
        if (Traders::takeTraderByUrl($id)) {
            return $this->render('detail',[
                'trader' => Traders::takeTraderByUrl($id),
                'barters' => Barters::takeBartersByTitle(Traders::takeTraderByUrl($id)->title)
            ]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /**
     * Рендер страницы предпросмотра детальной страницы торговца
     *
     * @return string
     * @throws HttpException
     */
    public function actionPreviewtrader(): string
    {
        if(Yii::$app->user->isGuest !== true) {
            // Отключаем CSRF валидацию POST запросов
            $this->enableCsrfValidation=false;
            $trader = new Traders;
            $trader->load(Yii::$app->request->post());
            return $this->render('trader-preview', ['trader' => $trader]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует!');
        }
    }

    /**
     * Рендер страницы предпросмотра бартера торговцев
     *
     * @return string
     * @throws HttpException
     */
    public function actionBarterspreview(): string
    {
        if(Yii::$app->user->isGuest !== true) {
            $barter = new Barters;
            $barter->load(Yii::$app->request->post());
            $id = Barters::find()->select('id')->where(['title' => $barter->title])->scalar();

            return $this->render('barter-preview', ['barter' => $barter, 'id' => $id]);
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

}