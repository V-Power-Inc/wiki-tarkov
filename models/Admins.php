<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admins".
 *
 * @property int $id
 * @property string $login 
 * @property string $real_name
 * @property string $passwd 
 * @property string $confirm
 */
class Admins extends ActiveRecord
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
            [['login', 'passwd'], 'required'],
            [['login', 'passwd'], 'string', 'max' => 100],
            ['passwd', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'real_name' => 'Real Name',
            'passwd' => 'Пароль',
            'confirm' => 'Confirm',
        ];
    }

    /******** Тут надо будет сделать IdentityInterface *********/
    
}
