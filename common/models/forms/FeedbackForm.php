<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.11.2023
 * Time: 18:42
 */

namespace app\common\models\forms;

use app\common\helpers\validators\ReCaptchaValidator;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;
use app\models\FeedbackMessages;
use yii\base\Model;
use Yii;

/**
 * Объект формы обратной связи для получения заявок от посетителей сайта
 *
 * Class FeedbackForm
 * @package app\common\models\forms
 */
class FeedbackForm extends Model
{
    /** @var string - Сообщения от посетителя */
    public $content;
    const ATTR_CONTENT = 'content';

    /** @var string $reCaptcha - Переменная для рекапчи false */
    public $reCaptcha = false;
    const RECAPTCHA = 'reCaptcha';

    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [static::ATTR_CONTENT, RequiredValidator::class],
            [static::ATTR_CONTENT, StringValidator::class, StringValidator::ATTR_MAX => 1000],
            [static::ATTR_CONTENT, StringValidator::class, StringValidator::ATTR_MIN => 10],

            [
                [static::RECAPTCHA],
                ReCaptchaValidator::class,
                ReCaptchaValidator::ATTR_SECRET => Yii::$app->params['recapchaKey'],
                ReCaptchaValidator::ATTR_UNCHECKED_MESSAGE => 'Подтвердите что вы не бот.'
            ]
        ];
    }

    /**
     * Переводы атрибутов
     *
     * @return array|string[]
     */
    public function attributeLabels(): array
    {
        return [
            static::ATTR_CONTENT => 'Сообщение',
            static::RECAPTCHA => 'Защита от спама',
        ];
    }

    /**
     * Метод сохранения нового обращения в БД
     *
     * @return bool
     */
    public function save(): bool
    {
        /** Переменная для return'a */
        $result = false;

        /** Если текущая форма провалидировалась */
        if ($this->validate()) {

            /** Создаем новый объект формы */
            $model = new FeedbackMessages();

            /** Сетапим форме сообщение, что нам послали */
            $model->content = $this->content;

            /** Сетапим переменной результат сохранения формы */
            $result = $model->save();
        }

        /** Возвращаем bool результат сохранения формы */
        return $result;
    }
}