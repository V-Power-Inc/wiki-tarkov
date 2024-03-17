<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 22:27
 */

namespace app\models\forms;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;
use app\common\helpers\validators\ReCaptchaValidator;
use yii\base\Model;
use Yii;

/**
 * Форма для осуществления поиска через API и дальнейшая обработка полученных данных
 *
 * Class ApiForm
 * @package app\models\forms
 */
final class ApiForm extends Model
{
    /** @var string - имя предмета */
    public $item_name;
    public const ATTR_ITEM_NAME = 'item_name';

    /** @var string - Переменная для рекапчи false */
    public $recaptcha = false;
    public const ATTR_RECAPTCHA = 'recaptcha';

    /**
     * Правила валидации модели
     *
     * @return array
     */
    public function rules()
    {
        return [
            [static::ATTR_ITEM_NAME, RequiredValidator::class],

            [static::ATTR_ITEM_NAME, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [
                [static::ATTR_RECAPTCHA],
                ReCaptchaValidator::class,
                ReCaptchaValidator::ATTR_SECRET => Yii::$app->params['recapchaKey'],
                ReCaptchaValidator::ATTR_UNCHECKED_MESSAGE => 'Подтвердите что вы не бот.'
            ]
        ];
    }

    /**
     * Переводы атрибутов текущей модели
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_ITEM_NAME => 'Название предмета',
            static::ATTR_RECAPTCHA => 'Проверка'
        ];
    }
}