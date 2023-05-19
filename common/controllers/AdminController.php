<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 06.08.2022
 * Time: 16:54
 *
 * Админский контроллер наследующийся от базового для удобных действий в админке
 *
 */

namespace app\common\controllers;

use Yii;
use yii\web\Response;

class AdminController extends \yii\web\Controller
{
    /** Используем трейт для множественного наследования */
    use ControllerRoutesTrait;

    /** @var string - Параметр ID */
    const PARAM_ID = 'id';

    /** @var string LOGIN_URL Константа урла для логина */
    const LOGIN_URL = '/admin/login';

    /** @var string LOGOUT_URL Константа урла для разлогинивания */
    const LOGOUT_URL = '/admin/logout';

    /** @var string $layout - Подключаем отдельный layout для CRUD контроллеров */
    public $layout = 'admin';

    /**
     * Проверяем пользователя на авторизацию, если не авторизован редирект на страницу логина
     * Предотвращаем доступ в админку и соблюдаем DRY паттерн таким образом
     * @param string $action - ID экшена
     * @return Response|$this
     */
    public function beforeAction($action)
    {
        /** Сразу разлогиниваем забаненных */
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->banned === 1) {
            return $this->redirect(AdminController::LOGOUT_URL);
        }

        /** Сначала редиректим неавторизованного на страницу логина */
        if (Yii::$app->user->isGuest && Yii::$app->request->url !== '/admin/login') {
            return $this->redirect(AdminController::LOGIN_URL);
        }

        /** Возвращаем экземпляр текущего класса */
        return $this;
    }
}