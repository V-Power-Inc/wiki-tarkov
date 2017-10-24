<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admins".
 *
 * @property int $id
 * @property string $user Почта
 * @property string $password Пароль
 * @property string $captcha Гугл капча
 * @property int $remember_me Галочка - запомнить
 */
class Admins extends \yii\db\ActiveRecord
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
            [['user', 'password', 'captcha', 'remember_me'], 'required'],
            [['remember_me'], 'integer'],
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
        ];
    }
}
