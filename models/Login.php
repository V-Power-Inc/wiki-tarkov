<?php
namespace app\models;

use yii\base\Model;
use app\models\Admins;

class Login extends Model
{
    public $email;
    public $password;
    public $rememberMe;
    private $_user = false;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            //['email','email'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LcN1DUUAAAAAEBtk-iF1wqtdPOx5eo3-uzljni_', 'uncheckedMessage' => 'Подтвердите что вы не бот.']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
            'reCaptcha' => 'От ботов'
        ];
    }
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * собственная функкция валидации
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params){
        if(!$this->hasErrors()){
            $user =  Admins::findOne(['user'=>$this->email]);

            if(!$user || ($user->password !== sha1($this->password))){
                $this->addError($attribute, 'Логин или пароль, введены не верно');
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {echo '<pre>';
            $this->_user = Admins::findOne(['user' =>$this->email]);
        }

        return $this->_user;
    }

}