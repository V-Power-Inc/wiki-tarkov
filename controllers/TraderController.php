<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 10.08.2022
 * Time: 22:23
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\common\services\ApiService;
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
class TraderController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_QUESTS                 = 'quests';
    const ACTION_QUESTS_DETAIL          = 'quests-detail';
    const ACTION_TRADERSDETAIL          = 'tradersdetail';
    const ACTION_BARTERS_PREVIEW        = 'barterspreview';
    const ACTION_PREVIEWTRADER          = 'previewtrader';

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
                'variations' => [
                    $_SERVER['SERVER_NAME'],
                    Yii::$app->request->url,
                    Yii::$app->response->statusCode,
                    Yii::$app->request->get('page'),
                    Yii::$app->request->cookies->get('overlay'),
                    Yii::$app->request->cookies->get('dark_theme')
                ]
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
        /** Есди нашли информацию о торговце по url */
        if (Traders::takeTraderByUrl($id)) {

            /** Рендерим вьюху с данными о нем */
            return $this->render('detail',[
                'trader' => Traders::takeTraderByUrl($id),
                'barters' => Barters::takeBartersByTitle(Traders::takeTraderByUrl($id)->title)
            ]);
        }

        /** Если не нашли информацию о торговце, выкидываем 404 ошибку */
        throw new HttpException(404 ,'Такая страница не существует');
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
            $trader = new Traders;
            $trader->load(Yii::$app->request->post());
            return $this->render('trader-preview', ['trader' => $trader]);
        }

        throw new HttpException(404 ,'Такая страница не существует!');
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
        }

        throw new HttpException(404 ,'Такая страница не существует');
    }
}