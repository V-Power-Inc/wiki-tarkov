<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 17.10.2018
 * Time: 12:25
 */

namespace app\controllers;

use app\common\controllers\AdvancedController;
use app\common\interfaces\ResponseStatusInterface;
use app\common\models\forms\ClansForm;
use app\models\Clans;
use yii\web\HttpException;
use app\components\MessagesComponent;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Json;
use yii\db\Query;
use Yii;

/**
 * Class ClanController
 * @package app\controllers
 */
final class ClanController extends AdvancedController
{
    /** Константы для передачи в маршрутизатор /config/routes.php */
    const ACTION_INDEX      = 'index';
    const ACTION_ADDCLAN    = 'add-clan';
    const ACTION_SAVE       = 'save';
    const ACTION_CLANSEARCH = 'clansearch';

    /*** Количество заявок для обработки в день ***/
    const ticketsDayLimit = 10;

    /**
     * Рендерим страницу списка кланов
     *
     * @return string
     */
    public function actionIndex(): string
    {
        /** Создаем объект класса - Кланы */
        $srcclan = new Clans();

        /** Получаем число - количество заявок поданных сегодня */
        $countickets = Clans::find()->where(['like', 'date_create', date('Y-m-d')])->count('*');

        /** Получаем список отмодерированных кланов */
        $clans = Clans::find()->where(['moderated' => 1])->orderBy(['date_create' => SORT_DESC])->cache(60)->asArray()->limit(20)->all();

        /** Вычисляем количество заявок на регистрацию клана, доступных на сегодня */
        $avialableTickets = self::ticketsDayLimit-$countickets;

        /** Рендерим вьюху */
        return $this->render(static::ACTION_INDEX, ['clans' => $clans, 'avialableTickets' => $avialableTickets, 'srcclan' => $srcclan, 'countdaylimit' => self::ticketsDayLimit]);
    }

    /**
     * Рендерим страницу добавления нового клана
     *
     * @return string|Response
     */
    public function actionAddClan()
    {
        /** Получаем число - количество заявок поданных сегодня */
        $countickets = Clans::find()->where(['like', 'date_create', date('Y-m-d')])->count('*');

        /** Вычисляем количество заявок на регистрацию клана, доступных на сегодня */
        $avialableTickets = self::ticketsDayLimit-$countickets;

        /** Если количество доступных для регистрации кланов на сегодня меньше или равно 0 */
        if($avialableTickets <= 0) {

            /** Сетапим флэш сообщение об этом (SetFlash) */
            $messages = new MessagesComponent();
            $message = "<p class='alert alert-danger size-16 margin-top-20' id='alert-clans'><b>Оформить заявку на регистрацию клана будет возможно только завтра.</b></p>";
            $messages->setMessages($message);

            /** Редиректим на страницу со списком кланов */
            return $this->redirect(static::ACTION_INDEX, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);

        } else { /** Если еще можно подать заявку на регистрацию клана */

            /** Создаем объект промежуточной формы кланов */
            $model = new ClansForm();

            /** Рендерим страницу с полями для регистрации клана */
            return $this->render(static::ACTION_ADDCLAN, ['model' => $model]);
        }
    }

    /**
     * Обработчик сохранения данных в БД
     *
     * 24_12_2023г. - Не самый лучший метод от старой логики остался
     *
     * @return array|Response
     * @throws HttpException
     */
    public function actionSave()
    {
        /** Создаем новый AR объект формы сохранения кланов */
        $model = new ClansForm();

        /** Создаем объект компонента для flash сообщений */
        $messages = new MessagesComponent();

        /** Ajax валидация - если запрос прилетел AJAX и были загружен POST данные в модель */
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {

            /** Формат ответа - JSON для AJAX валидации */
            Yii::$app->response->format = Response::FORMAT_JSON;

            /** Возвращаем результат валидации ActiveForm */
            return ActiveForm::validate($model);
        }

        /** Если запрос POST пришел и он не AJAX */
        if(Yii::$app->request->isPost && !Yii::$app->request->isAjax) {

            /** Получаем число - количество заявок поданных сегодня */
            $countickets = Clans::find()->where(['like', 'date_create', date('Y-m-d')])->count('*');

            /** Вычисляем количество заявок на регистрацию клана, доступных на сегодня */
            $avialableTickets = self::ticketsDayLimit-$countickets;

            /** Если количество доступных для регистрации кланов на сегодня меньше или равно 0 */
            if($avialableTickets <= 0) {

                /** Сетапим флэш сообщение об этом (SetFlash) */
                $message = "<p class='alert alert-danger size-16 margin-top-20' id='alert-clans'><b>Оформить заявку на регистрацию клана будет возможно только завтра.</b></p>";
                $messages->setMessages($message);

                /** Редиректим на страницу со списком кланов */
                return $this->redirect(static::ACTION_INDEX, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);

            } else { /** Если клан еще можно зарегистрировать сегодня (Есть свободные тикеты) */

                /** Если модель пыталась загрузить изображение и результат равен false */
                if($model->uploadPreview() === false) {

                    /** Сетапим флэш сообщение об этом (SetFlash) */
                    $message = "<p class='alert alert-danger size-16 margin-top-20' id='alert-clans'><b>Изображение должно быть размера 100x100 пикселей</b></p>";
                    $messages->setMessages($message);

                    /** Редиректим на страницу добавления кланов */
                    return $this->redirect(static::ACTION_ADDCLAN, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);

                } else { /** Если изображение удалось загрузить */

                    /** Грузим в модель остальные данные из POST */
                    $model->load(Yii::$app->request->post());

                    /** Если модель смогла сохраниться (Без валидации) */
                    if ($model->save()) {

                        /** Сетапим флэш сообщение об этом (SetFlash) */
                        $message = "<p class='alert alert-success size-16 margin-top-20'><b>Заяка о регистрации клана успешно отправлена на рассмотрение!</b></p>";
                        $messages->setMessages($message);

                        /** Редиректим на страницу со списком кланов */
                        return $this->redirect(static::ACTION_INDEX, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);

                    } else { /** Если данные по каким то причинам не смогли сохраниться */

                        /** Сетапим флэш сообщение об этом (SetFlash) - указываем, что о баге можно сообщить на электронную почту */
                        $message = "<p class='alert alert-danger size-16 margin-top-20'><b>Заявка не была отправлена, напишите об этом на <b>tarkov-wiki@ya.ru</b></b></p>";
                        $messages->setMessages($message);

                        /** Редиректим на страницу добавления кланов */
                        return $this->redirect(static::ACTION_ADDCLAN, ResponseStatusInterface::REDIRECT_TEMPORARILY_CODE);
                    }
                }
            }
        } else { /** Если пришел запрос не подходящий не под один из критериев */

            /** Выкидываем 404 ошибку */
            throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
        }
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

            /** Преподгатавливаем переменную для запроса к БД */
            $query = new Query;

            /** Определяем запрос и ищем клан по названию */
            $query->select('title, description, preview, link, date_create')
                ->from('clans')
                ->where('title LIKE "%' . $q . '%"')
                ->andWhere(['moderated' => 1])
                ->orderBy('date_create DESC')
                ->limit(30)
                ->cache(60);

            /** Определяем команду и выполняем запрос */
            $command = $query->createCommand();

            /** Указываем выбрать все нужные записи */
            $data = $command->queryAll();

            /** Массив для резултирующих данных */
            $out = [];

            /** В цикле наполняем массив с результирующими данными - в нужном формате **/
            foreach ($data as $d) {
                $out[] = ['value' => $d['title'], 'title' => $d['title'], 'description' => $d['description'], 'preview' => $d['preview'], 'link' => $d['link'], 'date_create' => $d['date_create']];
            }

            /** Возвращаем результирующий массив в формате Json */
            return Json::encode($out);

        } else { /** Если запрос сюда прилетел иным образом */

            /** Выкидываем 404 ошибку */
            throw new HttpException(ResponseStatusInterface::NOT_FOUND_CODE ,'Такая страница не существует');
        }
    }
}