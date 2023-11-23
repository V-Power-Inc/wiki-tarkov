<?php

namespace app\models;

use app\common\helpers\validators\BooleanValidator;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\ReCaptchaValidator;
use yii\base\Model;
use Yii;

/**
 * Класс логинящий пользователя в админку
 *
 * Class Login
 * @package app\models
 */
class Login extends Model
{
    /** @var string - Название текущего класса */
    const CLASS_NAME = 'Login';

    /** @var string - Атрибут модели email */
    public $email;
    const ATTR_EMAIL = 'email';

    /** @var string - Атрибут модели пароль */
    public $password;
    const ATTR_PASSWORD = 'password';

    /** @var string - Атрибут модели - запомнить пользователя или нет */
    public $rememberMe;
    const ATTR_REMEMBER_ME = 'rememberMe';

    /** @var Admins - Объект пользователя */
    private $_user = false;

    /** @var string - Атрибут модели - капча */
    public $reCaptcha = false;
    const ATTR_RECAPTCHA = 'reCaptcha';

    /** @var string - Константы для рекапчи, прописал их здесь, чтобы не городить класс - прослойку ради этого */
    const ATTR_RECAPTCHA_SECRET = 'secret';
    const ATTR_RECAPTCHA_UNCHECKED_MESSAGE = 'uncheckedMessage';

    /**
     * Массив валидаций текущей модели
     *
     * @return array
     */
    public function rules()
    {
        return [
            [static::ATTR_EMAIL, RequiredValidator::class],

            [static::ATTR_PASSWORD, RequiredValidator::class],

            [static::ATTR_REMEMBER_ME, BooleanValidator::class],

            [static::ATTR_PASSWORD, 'validatePassword'],

            [
                [static::ATTR_RECAPTCHA],
                ReCaptchaValidator::class,
                ReCaptchaValidator::ATTR_SECRET => Yii::$app->params['recapchaKey'],
                ReCaptchaValidator::ATTR_UNCHECKED_MESSAGE => 'Подтвердите что вы не бот.'
            ]
        ];
    }

    /**
     * Массив переводов атрибутов текущей модели
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_EMAIL => 'E-mail',
            static::ATTR_PASSWORD => 'Пароль',
            static::ATTR_REMEMBER_ME => 'Запомнить меня',
            static::ATTR_RECAPTCHA => 'От ботов'
        ];
    }
    /**
     * Функция логинящая пользователя в админку
     *
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        /** Если текущая модель прошла валидации */
        if ($this->validate()) {

            /** Логиним пользователя */
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }

        /** Иначе, возвращаем false результат */
        return false;
    }

    /**
     * Собственная функкция валидации пользователя
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params){

        /** Если при валидации модели нет ошибок */
        if (!$this->hasErrors()){

            /** Ищем в БД пользователя с таким логином */
            $user = Admins::findOne([Admins::ATTR_USER => $this->email]);

            /** Если не нашли такого пользователя или у него неправильный пароль */
            if (!$user || ($user->password !== sha1($this->password))){

               /** Возвращаем во вьюху сообщение с ошибкой */
               return $this->addError($attribute, 'Логин или пароль, введены не верно');
            }

            /** Если посетитель был забанен */
            if ($user->banned === Admins::ATTR_BANNED_TRUE) {

                /** Выводим сообщение об этом */
                return $this->addError($attribute, 'Пользователь деактивирован');
            }
        }
    }

    /**
     * Ищем юзера и пробуем его засетапить в атрибут текущего класса
     * Вернем AR объект пользователя или null
     *
     * @return Admins|null
     */
    public function getUser()
    {
        /** Если атрибут текущего класса с пользователем равен false */
        if ($this->_user === false) {

            /** Сетапим атрибуту текущего класса - пользователя по логину из AR Admins */
            $this->_user = Admins::findOne([Admins::ATTR_USER => $this->email]);
        }

        /** Возвращаем единичный AR объект класса Admins с пользователем */
        return $this->_user;
    }
}