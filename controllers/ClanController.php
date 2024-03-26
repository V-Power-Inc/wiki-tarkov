<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 17.10.2018
 * Time: 12:25
 */

namespace app\controllers;

use app\common\constants\log\ErrorDesc;
use app\common\controllers\AdvancedController;
use app\common\interfaces\ResponseStatusInterface;
use app\common\models\forms\ClansForm;
use app\common\services\JsondataService;
use app\common\services\LogService;
use app\components\CookieComponent;
use app\models\Clans;
use app\models\ClansSearch;
use yii\base\InvalidConfigException;
use yii\web\HttpException;
use yii\widgets\ActiveForm;
use yii\web\Response;
use Yii;

/**
 * Class ClanController
 * @package app\controllers
 */
final class ClanController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    public const ACTION_INDEX      = 'index';
    public const ACTION_ADDCLAN    = 'add-clan';
    public const ACTION_SAVE       = 'save';
    public const ACTION_CLANSEARCH = 'clansearch';

    /*** Константа, количество заявок для обработки в день ***/
    public const PARAM_TICKETS_DAY_LIMIT = 10;

    /**
     * Рендерим страницу списка кланов
     *
     * @return string
     */
    public function actionIndex(): string
    {
        /** Создаем объект класса - Кланы */
        $srcclan = new Clans();

        /** Получаем список отмодерированных кланов */
        $clans = Clans::find()->where([Clans::ATTR_MODERATED => Clans::TRUE])->orderBy([Clans::ATTR_DATE_CREATE => SORT_DESC])->cache(60)->asArray()->limit(20)->all();

        /** Вычисляем количество заявок на регистрацию клана, доступных на сегодня */
        $avialableTickets = self::PARAM_TICKETS_DAY_LIMIT - ClansSearch::getTodayTicketsCount();

        /** Рендерим вьюху */
        return $this->render(self::ACTION_INDEX, [
            'clans' => $clans,
            'avialableTickets' => $avialableTickets,
            'srcclan'          => $srcclan,
            'countdaylimit'    => self::PARAM_TICKETS_DAY_LIMIT
        ]);
    }

    /**
     * Рендерим страницу добавления нового клана
     *
     * @return string|Response
     */
    public function actionAddClan()
    {
        /** Вычисляем количество заявок на регистрацию клана, доступных на сегодня */
        $avialableTickets = self::PARAM_TICKETS_DAY_LIMIT - ClansSearch::getTodayTicketsCount();

        /** Если количество доступных для регистрации кланов на сегодня меньше или равно 0 */
        if ($avialableTickets <= 0) {

            /** Сетапим флэш сообщение об этом (SetFlash) */
            CookieComponent::setMessages("<p class='alert alert-danger size-16 margin-top-20' id='alert-clans'><b>Оформить заявку на регистрацию клана будет возможно только завтра.</b></p>");

            /** Редиректим на страницу со списком кланов */
            return $this->redirect(self::ACTION_INDEX, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);

        } else { /** Если еще можно подать заявку на регистрацию клана */

            /** Создаем объект промежуточной формы кланов */
            $model = new ClansForm();

            /** Рендерим страницу с полями для регистрации клана */
            return $this->render(self::ACTION_ADDCLAN, ['model' => $model]);
        }
    }

    /**
     * Обработчик сохранения данных нового клана в БД
     *
     * @return array|Response
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionSave()
    {
        /** Создаем новый AR объект формы сохранения кланов */
        $model = new ClansForm();

        /** Ajax валидация - если запрос прилетел AJAX и были загружен POST данные в модель */
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {

            /** Формат ответа - JSON для AJAX валидации */
            Yii::$app->response->format = Response::FORMAT_JSON;

            /** Возвращаем результат валидации ActiveForm */
            return ActiveForm::validate($model);
        }

        /** Если запрос POST пришел и он не AJAX */
        if (Yii::$app->request->isPost && !Yii::$app->request->isAjax) {

            /** Вычисляем количество заявок на регистрацию клана, доступных на сегодня */
            $avialableTickets = self::PARAM_TICKETS_DAY_LIMIT - ClansSearch::getTodayTicketsCount();

            /** Если количество доступных для регистрации кланов на сегодня меньше или равно 0 */
            if ($avialableTickets <= 0) {

                /** Сетапим флэш сообщение об этом (SetFlash) */
                CookieComponent::setMessages("<p class='alert alert-danger size-16 margin-top-20' id='alert-clans'><b>Оформить заявку на регистрацию клана будет возможно только завтра.</b></p>");

                /** Редиректим на страницу со списком кланов */
                return $this->redirect(self::ACTION_INDEX, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);

            } else { /** Если клан еще можно зарегистрировать сегодня (Есть свободные тикеты) */

                /** Если модель пыталась загрузить изображение и атрибут изображения задан */
                if ($model->uploadPreview() && empty($model->preview)) {

                    /** Сетапим флэш сообщение об этом (SetFlash) */
                    CookieComponent::setMessages("<p class='alert alert-danger size-16 margin-top-20' id='alert-clans'><b>Изображение должно быть размера 100x100 пикселей</b></p>");

                    /** Редиректим на страницу добавления кланов */
                    return $this->redirect(self::ACTION_ADDCLAN, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);

                } else { /** Если изображение удалось загрузить */

                    /** Грузим в модель остальные данные из POST */
                    $model->load(Yii::$app->request->post());

                    /** Если модель смогла сохраниться (Без валидации) */
                    if ($model->save()) {

                        /** Сетапим флэш сообщение об этом (SetFlash) */
                        CookieComponent::setMessages("<p class='alert alert-success size-16 margin-top-20'><b>Заяка о регистрации клана успешно отправлена на рассмотрение!</b></p>");

                        /** Редиректим на страницу со списком кланов */
                        return $this->redirect(self::ACTION_INDEX, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);

                    } else { /** Если данные по каким то причинам не смогли сохраниться */

                        /** Логируем этот кейс в БД, т.к. необычная ошибка */
                        LogService::saveErrorData(Yii::$app->request->getUrl(), ErrorDesc::TYPE_CLAN_SAVE_ERROR, ErrorDesc::DESC_CLAN_SAVE_ERROR, ResponseStatusInterface::OK_CODE);

                        /** Сетапим флэш сообщение об этом (SetFlash) - указываем, что о баге можно сообщить на электронную почту */
                        CookieComponent::setMessages("<p class='alert alert-danger size-16 margin-top-20'><b>Заявка не была отправлена, напишите об этом на <b>tarkov-wiki@ya.ru</b></b></p>");

                        /** Редиректим на страницу добавления кланов */
                        return $this->redirect(self::ACTION_ADDCLAN, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);
                    }
                }
            }
        }

        /** Выкидываем 404 ошибку - если пришел запрос не подходящий не под один из критериев */
        throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
    }

    /**
     * Функция возвращающая название клана в формате JSON по поисковому запросу пользователя
     *
     * @param string|null $q - поисковый запрос
     * @return string
     * @throws HttpException
     * @throws \yii\db\Exception
     */
    public function actionClansearch(string $q = null): string
    {
        /** Если запрос пришел через AJAX */
        if (Yii::$app->request->isAjax) {

            /** Возвращаем результат поиска кланов в виде Json */
            return JsondataService::getClansList($q);

        } else { /** Если запрос сюда прилетел иным образом */

            /** Выкидываем 404 ошибку */
            throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
        }
    }
}