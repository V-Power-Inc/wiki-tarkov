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
use yii\base\Action;

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

    /** @var string $layout - Подключаем отдельный layout для CRUD контроллеров */
    public $layout = 'admin';

    /** @var string - Параметр ID */
    public const PARAM_ID = 'id';

    /** @var string LOGIN_URL Константа урла для логина */
    public const LOGIN_URL = '/admin/login';

    /** @var string LOGOUT_URL Константа урла для разлогинивания */
    public const LOGOUT_URL = '/admin/logout';

    /**
     * Проверяем пользователя на авторизацию, если не авторизован редирект на страницу логина
     * Предотвращаем доступ в админку и соблюдаем DRY паттерн таким образом
     *
     * @param Action $action - объект Action
     *
     * @return Response|bool
     */
    public function beforeAction($action)
    {
        /** Если пользователь авторизовался но является забаненым */
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->banned === Admins::ATTR_BANNED_TRUE) {

            /** Сразу его разлогиниваем */
            return $this->redirect(AdminController::LOGOUT_URL);
        }

        /** Если пользователь не авторизован и пытается лезть на страницы админки */
        if (Yii::$app->user->isGuest && Yii::$app->request->url !== AdminController::LOGIN_URL) {

            /** Редиректим его на страницу логина */
            return $this->redirect(AdminController::LOGIN_URL);
        }

        /** Возвращаем родительский beforeAction */
        return parent::beforeAction($action);
    }

    /**
     * Обработчик ошибок - отображает статусы ответа сервера
     *
     * @return array
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}