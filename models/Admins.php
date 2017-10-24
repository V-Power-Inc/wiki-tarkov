<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admins".
 *
 * @property int $id
 * @property string $login 
 * @property string $real_name 
 * @property string $passwd 
 * @property string $confirm
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
            [['login', 'real_name', 'passwd', 'confirm'], 'required'],
            [['login', 'real_name', 'passwd'], 'string', 'max' => 45],
            [['confirm'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'real_name' => 'Real Name',
            'passwd' => 'Passwd',
            'confirm' => 'Confirm',
        ];
    }
}
