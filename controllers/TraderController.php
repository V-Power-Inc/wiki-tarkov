<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 10.08.2022
 * Time: 22:23
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\common\exceptions\http\controllers\app\TraderControllerHttpException;
use app\common\interfaces\ResponseStatusInterface;
use app\common\services\ApiService;
use app\common\services\redis\RedisVariationsConfig;
use app\models\Barters;
use app\models\Traders;
use yii\web\HttpException;
use Yii;

/**
 * Это контроллер торговцев и связанных с ними действий
 *
 * Class TraderController
 * @package app\controllers
 */
final class TraderController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    public const ACTION_QUESTS                 = 'quests';
    public const ACTION_QUESTS_DETAIL          = 'quests-detail';
    public const ACTION_TRADERSDETAIL          = 'tradersdetail';
    public const ACTION_BARTERS_PREVIEW        = 'barterspreview';
    public const ACTION_PREVIEWTRADER          = 'previewtrader';

    /** CSRF валидация POST запросов методов этого контроллера включена по умолачнию */
    public $enableCsrfValidation;

    /**
     * Массив поведения данного контроллера
     * Подключаем REDIS кеширование для большинства страниц из этого контроллера
     *
     * @return array|array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheTime']['seven_days'],
                'variations' => RedisVariationsConfig::getMainControllerVariations()
            ],
        ];
    }

    /**
     * Метод рендерит квесты на детальных страницах торговцев
     * сами квесты получает из API, после чего сохраняет в БД, далее уже берет из таблицы tasks
     * Если таблица будет пуста или не будет квестов для определенного торговца
     * Выкинет 404 ошибку, нужно будет смотреть в tasks, чтобы понять в чем дело
     *
     * @param string $url - URL до квестов торговца
     * @return string
     * @throws \Throwable
     * @throws HttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionQuestsDetail(string $url): string
    {
        /** Инициализируем новый объект класса API */
        $api = new ApiService();

        /** Пременная - запрос на получение квестов из БД */
        $tasks = $api->getTasks($url);

        /** Рендер вьюхи */
        return $this->render('quests', ['tasks' => $tasks]);
    }

    /**
     * Рендер главной страницы со списком торговцев
     *
     * @return string
     */
    public function actionQuests(): string
    {
        /** Рендер страницы со списком торговцев */
        return $this->render('quests-main', ['traders' => Traders::takeTraders()]);
    }

    /**
     * Рендер детальной страницы торговца
     *
     * @param $id - url адрес торговца
     * @return string
     * @throws TraderControllerHttpException
     */
    public function actionTradersdetail($id): string
    {
        /** Есди нашли информацию о торговце по url */
        if (Traders::takeTraderByUrl($id)) {

            /** Рендерим вьюху с данными о нем */
            return $this->render('detail',[
                'trader'  => Traders::takeTraderByUrl($id),
                'barters' => Barters::takeBartersByTitle(Traders::takeTraderByUrl($id)->title)
            ]);
        }

        /** Если не нашли информацию о торговце, выкидываем 404 ошибку */
        throw new TraderControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Рендер страницы предпросмотра детальной страницы торговца
     *
     * @return string
     * @throws TraderControllerHttpException
     */
    public function actionPreviewtrader(): string
    {
        /** Если пользователь авторизован в админке */
        if (Yii::$app->user->isGuest !== true) {

            /** Создаем новый объект торговца */
            $trader = new Traders;

            /** Загружаем в него POST данные */
            $trader->load(Yii::$app->request->post());

            /** Рендерим вьюху со страницей предпросмотра торговца */
            return $this->render('trader-preview', ['trader' => $trader]);
        }

        /** Выкидываем 404 ошибку, если сюда пытались зайти неавторизованные пользователи */
        throw new TraderControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует.');
    }

    /**
     * Рендер страницы предпросмотра бартера торговцев
     *
     * @return string
     * @throws TraderControllerHttpException
     */
    public function actionBarterspreview(): string
    {
        /** Если пользователь авторизован */
        if (Yii::$app->user->isGuest !== true) {

            /** Создаем новый объект бартера */
            $barter = new Barters;

            /** Грузим в объект данные из POST */
            $barter->load(Yii::$app->request->post());

            /** Находим нужного торговца по ID в БД */
            $id = Barters::getBarterIdByTitle($barter->title);

            /** Рендерим вьюху по торговцу с предпросмотром бартеров */
            return $this->render('barter-preview', [
                'barter' => $barter,
                'id'     => $id
            ]);
        }

        /** Выкидываем 404 ошибку, если пользователь не авторизован */
        throw new TraderControllerHttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }
}