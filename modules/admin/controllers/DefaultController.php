<?php

namespace app\modules\admin\controllers;

use Yii;
use app\common\controllers\AdminController;
use app\models\Login;

/**
 * Default controller for the `admin` module
 */
final class DefaultController extends AdminController
{
    /** @var string - Константы для обращения к методам */
    public const ACTION_INDEX  = 'index';
    public const ACTION_LOGIN  = 'login';
    public const ACTION_LOGOUT = 'logout';

    /**
     * Рендер главной страницы админки
     *
     * @return string
     */
    public function actionIndex(): string
    {
        /** Рендерим вьюху */
        return $this->render(static::ACTION_INDEX);
    }

    /** Рендер страницы авторизации **/
    public function actionLogin()
    {
        /** Если пользователь авторизован */
        if(!Yii::$app->user->isGuest){

            /** Возвращаем ему главную страницу админки */
            return self::actionIndex();
        }

        /** Создаем объект модели логина */
        $model = new Login();

        /** Если из POST смогли загрузить данные о пользователе */
        if (Yii::$app->request->post(Login::CLASS_NAME)){

            /** Присваиваем атрибутам модели логина - данные из POST */
            $model->attributes = Yii::$app->request->post(Login::CLASS_NAME);

            /** Если данные провалидировались */
            if ($model->validate()) {

                /** Логиним юзера */
                Yii::$app->user->login($model->getUser());

                /** Возвращаем ему главную страницу админки */
                return self::actionIndex();
            }
        }

        /** Рендерим страницу логина */
        return $this->render(static::ACTION_LOGIN, ['model' => $model]);
    }

    /**
     * При заходе в этот экшен - мы разлогиниваем и дериректим на главную страницу
     *
     * @return string
     */
    public function actionLogout(): string
    {
        /** Разлогиниваем пользователя */
        Yii::$app->user->logout();

        /** Возвращаем страницу логина разлогиненному пользователю */
        return self::actionLogin();
    }
}