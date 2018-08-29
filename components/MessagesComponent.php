<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.08.2018
 * Time: 23:13
 */

namespace app\components;

class MessagesComponent
{
    /**
     * устанавливаем сообщение
     * @param $messageText
     * UniversalComponent
     */
    public function setMessages($messageText){
        \Yii::$app->response->cookies->remove('message');
        \Yii::$app->getSession()->setFlash('message',$messageText);
    }
}