<?php

namespace app\modules\admin\controllers;

use Yii;
use app\common\controllers\AdminController;
use app\models\Login;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminController
{
    const ACTION_INDEX  = 'index';
    const ACTION_LOGIN  = 'login';
    const ACTION_LOGOUT = 'logout';

    /** Рендер главной страницы админки **/
    public function actionIndex()
    {
        return $this->render('index');
    }

    /** Рендер страницы авторизации **/
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest){
            return self::actionIndex();
        }
        $model = new Login();
        if(Yii::$app->request->post('Login')){
            $model->attributes = Yii::$app->request->post('Login');

            if($model->validate()){
                \Yii::$app->user->login($model->getUser());
                return $this->redirect('/admin');
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    /** При заходе в этот экшен - мы разлогиниваем и дериректим на главную страницу */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return self::actionLogin();
    }
}
