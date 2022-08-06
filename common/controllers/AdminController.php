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

// todo: Сюда еще вернемся для константного подхода в маршрутизации


class AdminController extends \yii\web\Controller
{
    use ControllerRoutesTrait;

    const ACTION_INDEX = 'index';

    /** Подключаем отдельный layout для CRUD моделей **/
    public $layout = 'admin';

    /**
     * Проверяем пользователя на авторизацию, если не авторизован редирект на страницу логина
     * Предотвращаем доступ в админку и соблюдаем DRY паттерн таким образом
     */
    public function beforeAction($action)
    {
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->banned === 1) {
            return $this->redirect('/admin/default/logout');
        }

        if (Yii::$app->user->isGuest && Yii::$app->request->url !== '/admin/login') {
            return $this->redirect('/admin/login');
        } else {
            return AdminController::ACTION_INDEX;
        }
    }

    /** Заглушка для дальнейшего наследования */
    public function actionIndex()
    {}




}