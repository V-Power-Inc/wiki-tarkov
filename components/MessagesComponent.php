<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.08.2018
 * Time: 23:13
 */

namespace app\components;

/**
 * Класс для отображения пользовательских сообщений на сайте через SetFlash
 *
 * Class MessagesComponent
 * @package app\components
 */
class MessagesComponent
{
    /**
     * Метод устанавливает пользовательские сообщения SetFlash по параметру строки
     *
     * @param string $messageText
     * @return void
     */
    public function setMessages(string $messageText): void
    {
        \Yii::$app->response->cookies->remove('message');
        \Yii::$app->getSession()->setFlash('message',$messageText);
    }
}