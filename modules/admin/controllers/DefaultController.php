<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Admins;
use app\models\Login;
/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /** Подключаем отдельный layout для админки сайта **/
    public $layout = 'admin';
    

    /** Проверка пользователя на гостя  **/
    public function beforeAction($action)
    {
        if(!Yii::$app->user->isGuest && Yii::$app->user->identity->banned === 1) {
            return $this->redirect('/admin/default/logout');
        }

        if (Yii::$app->user->isGuest && Yii::$app->request->url !== '/admin/login') {
            return $this->redirect('/admin/login');
        } else {
           return self::actionIndex();
        }
    }
    
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
        return $this->render('login', [ 'model' => $model,]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return self::actionLogin();
    }
    
    
    
}
