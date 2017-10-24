<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Admins;

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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Admins();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', ['model' => $model,]);
    }
    
}
