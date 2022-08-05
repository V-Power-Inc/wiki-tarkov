<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $login
 * @property string $comment
 * @property int $enabled
 * @property string $admin_review
 * @property string $date_create
 */
class Reviews extends \yii\db\ActiveRecord
{

    public $reCaptcha = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'comment'], 'required'],
            [['comment', 'admin_review', 'date_create'], 'string', 'max' => 255],
            [['enabled'], 'integer'],
            [['login'], 'string', 'max' => 255],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::class, 'secret' => '6LeP7D0UAAAAAKyqeAm_ttorHJGS99_gQJ6Fo5me', 'uncheckedMessage' => 'Подтвердите что вы не бот.']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Ваш псевдоним',
            'comment' => 'Отзыв',
            'enabled' => 'Активен',
            'admin_review' => 'Ответ администрации',
            'date_create' => 'Дата отправки отзыва',
            'reCaptcha' => 'От ботов'
        ];
    }
}
