<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;
/**
 * This is the model class for table "admins".
 *
 * @property int $id
 * @property string $user Почта
 * @property string $password Пароль
 * @property string $captcha Гугл капча
 * @property int $remember_me Галочка - запомнить
 * @property string $role
 * @property string $name
 * @property string $date_end
 */
class Admins extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'password', 'remember_me'], 'required'],
            [['remember_me'], 'integer'],
            [['captcha','role','name'], 'safe'],
            [['user', 'password'], 'string', 'max' => 45],
            [['captcha'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'password' => 'Password',
            'captcha' => 'Captcha',
            'remember_me' => 'Remember Me',
            'role' => 'Уровень прав учетной записи',
            'date_end' => 'Дата окончания учетной записи',
            'name' => 'Имя пользователя учетной записи',
        ];
    }

    /**
     * валидируем пароль
     * @param $password
     * @return bool
     */
    public function validatePassword($password){
        return $this->password == md5($password);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        //return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        //return $this->authKey === $authKey;
    }
}
