<?php
/**
 * Created by PhpStorm.
 * User: comp
 * Date: 29.08.2018
 * Time: 23:13
 */

namespace app\components;

use Yii;

/**
 * Класс для отображения пользовательских сообщений на сайте через SetFlash
 *
 * Class MessagesComponent
 * @package app\components
 *
 * @author Mikhail Dimitrenko
 */
class MessagesComponent
{
    /**
     * Метод устанавливает пользовательские сообщения SetFlash по параметру строки
     *
     * @param string $messageText - сообщение, которое будет отображено во вьюхе (Может быть html кодом)
     * @return void
     */
    public function setMessages(string $messageText): void
    {
        /** Удаляем кукис messages */
        Yii::$app->response->cookies->remove('message');

        /** Устанавливаем в текущую сессию flash сообщение с текстом */
        Yii::$app->getSession()->setFlash('message',$messageText);
    }
}