<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.08.2018
 * Time: 22:28
 */

namespace app\modules\admin\controllers;

use Yii;
use yii\web\HttpException;
use app\models\Admins;
use app\components\MessagesComponent;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\common\controllers\AdminController;


/*** Это контроллер модерации пользователей админки - всех неверных наказывают тут ***/
class ModeratorController extends AdminController
{

    /** Пускаем в этот контроллер только пользователей PC_Principal, Enslaver45 - оставляем проверку такой, т.к. она отличается
     *  от унаследованного из AdminController
     */
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && Yii::$app->request->url !== '/admin/login') {
            return $this->redirect('/admin/login');
        } else if(Yii::$app->user->identity->id === 1 || Yii::$app->user->identity->id === 2) {
            return self::actionIndex();
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }

    /*** Рендер страницы модерации пользователей админки ***/
    public function actionIndex() {
        $users = new Admins();

        $countusers = $users->UsersCount();
        $bannedusers = $users->bannedUsers();
        $active_users = $users->unbannedUsers();

        if($active_users == false) {
            return $this->redirect('/admin/login', 301);
        }

        $array_users = $users->takeAllUsers();

        return $this->render('index', [
            'users' => $users,
            'countusers' => $countusers,
            'bannedusers' => $bannedusers,
            'active_users' => $active_users,
            'array_users' => $array_users]);
    }

    /*** Рендер события сохранения нового пользователя ***/
    public function actionUserSave() {

        $new_user = new Admins();

        if (Yii::$app->request->isAjax && $new_user->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($new_user);
        }

        if(Yii::$app->request->isPost) {


            $new_user->load(Yii::$app->request->post());
            $new_user->password = sha1($new_user->password);

            if($new_user->save(false)) {
                $messages = new MessagesComponent();
                $message =  "<p class='alert alert-success size-16 margin-top-20'>Новый пользователь успешно сохранен.</p>";
                $messages->setMessages($message);
                return $this->redirect('/admin/ass-destroyer', 301);
            }
        } else {
            $messages = new MessagesComponent();
            $message =  "<p class='alert alert-danger size-16 margin-top-20'>Возникла неизвестная ошибка.</p>";
            $messages->setMessages($message);
            return $this->redirect('/admin/ass-destroyer');
        }
    }

    /*** Рендер события бана предателей идеи ***/
    public function actionUserBan() {
        if(Yii::$app->request->isPost) {
          $bannuser = new Admins();
          $bannuser->load(Yii::$app->request->post());

          $usrtofind = Admins::find()->where(['id' => $bannuser->name])->one();

          $usrtofind->user = 'banned-'.date('Y-m-d H:i:s');
          $usrtofind->password = 'Need to regenerate';
          $usrtofind->banned = 1;
          $usrtofind->bann_reason = $bannuser->bann_reason;
          $usrtofind->save(false);
          $messages = new MessagesComponent();
          $message =  "<p class='alert alert-success size-16 margin-top-20'>Пользователь <b>$usrtofind->name</b> был забанен!</p>";
          $messages->setMessages($message);
          return $this->redirect('/admin/ass-destroyer');

        } else {
            $messages = new MessagesComponent();
            $message =  "<p class='alert alert-danger size-16 margin-top-20'>Возникла неизвестная ошибка.</p>";
            $messages->setMessages($message);
            return $this->redirect('/admin/ass-destroyer');
        }
    }

}