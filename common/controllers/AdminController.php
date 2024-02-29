<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 06.08.2022
 * Time: 16:54
 */

namespace app\common\controllers;

use app\models\Admins;
use Yii;
use yii\web\Response;
use yii\web\Controller;

/**
 * Контроллер, для наследования контроллерами, созданными для администрирования сайта
 *
 * Class AdminController
 * @package app\common\controllers
 */
class AdminController extends Controller
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
     *
     * @param string $action - ID экшена
     *
     * @return Response|$this
     */
    public function beforeAction($action)
    {
        /** Если пользователь авторизовался но является забаненым */
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->banned === Admins::ATTR_BANNED_TRUE) {

            /** Сразу его разлогиниваем */
            return $this->redirect(AdminController::LOGOUT_URL);
        }

        /** Если пользователь не авторизован и пытается лезть на страницы админки */
        if (Yii::$app->user->isGuest && Yii::$app->request->url !== '/admin/login') {

            /** Редиректим его на страницу логина */
            return $this->redirect(AdminController::LOGIN_URL);
        }

        /** Возвращаем экземпляр текущего класса */
        return $this;
    }
}