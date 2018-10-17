<?php
/**
 * Created by PhpStorm.
 * User: DIR300NRU-ADMIN
 * Date: 17.10.2018
 * Time: 12:25
 */

namespace app\controllers;
use yii\web\Controller;
use app\models\Clans;
use yii\web\HttpException;
use app\components\MessagesComponent;
use Yii;

class ClanController extends Controller {
    
    /*** Рендерим страницу списка кланов ***/
    public function actionIndex() {
    
        $clans = Clans::find()->where(['moderated' => 1])->asArray()->all();
        
        return $this->render('/clans/index', ['clans' => $clans]);
    }
    
    /*** Рендерим страницу добавления нового клана ***/
    public function actionAddclan() {
        $model = new Clans();
        
        return $this->render('/clans/add-clan', ['model' => $model]);
    }
    
    /*** Обработчик сохранения данных в БД ***/
    public function actionSave() {
        if(Yii::$app->request->isPost) {
            $model = new Clans();

            $model->load(Yii::$app->request->post());

            if($model->save(false)) {
                $messages = new MessagesComponent();
                $message = "<p class='alert alert-success size-16 margin-top-20'><b>Заяка о регистрации клана успешно отправлена на рассмотрение!</b></p>";
                $messages->setMessages($message);
                return $this->redirect('/clans', 301);
            } else {
                $messages = new MessagesComponent();
                $message = "<p class='alert alert-danger size-16 margin-top-20'><b>Заявка не была отправлена, напишите об этом в онлайн-консультант.</b></p>";
                $messages->setMessages($message);
                return $this->redirect('/add-clan', 301);
            }
        } else {
            throw new HttpException(404 ,'Такая страница не существует');
        }
    }
    
}