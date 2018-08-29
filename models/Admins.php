<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;
/**
 * This is the model class for table "admins".
 *
 * @property int $id
 * @property int $banned
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
            [['user', 'password', 'name', 'role'], 'required'],
            [['user'], 'unique', 'message' => 'Логин пользователя должен быть уникальным.'],
            [['remember_me', 'banned'], 'integer'],
            [['captcha','role','name','remember_me'], 'safe'],
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
            'user' => 'Логин пользователя',
            'password' => 'Пароль пользователя',
            'captcha' => 'Captcha',
            'remember_me' => 'Remember Me',
            'role' => 'Роль',
            'date_end' => 'Дата окончания учетной записи',
            'name' => 'Имя пользователя учетной записи',
            'banned' => 'Забанен'
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

    /*** Получаем всех незабаненных пользователей в виде объектов кроме себя ***/
    public function unbannedUsers() {
        return self::find()->where(['banned' => null])->andWhere(['not like', 'id', Yii::$app->user->identity->id])->all();
    }

    /*** Получаем общее количество пользователей в системе ***/
    public function UsersCount() {
       return self::find()->count();
    }

    /*** Получаем количество забаненных пользователей ***/
    public function bannedUsers() {
        return self::find()->where(['banned' => 1])->count();
    }

    /*** Получаем всех пользователей сайта в виде массива ***/
    public function takeAllUsers() {
        return self::find()->asArray()->all();
    }

}
