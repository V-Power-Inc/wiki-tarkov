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
use himiklab\yii2\recaptcha\ReCaptchaValidator;
use yii\base\Model;

/**
 * Форма для осуществления поиска через API и дальнейшая обработка полученных данных
 *
 * Class ApiForm
 * @package app\models\forms
 */
class ApiForm extends Model
{
    /** @var string - имя предмета */
    public $item_name;
    const ATTR_ITEM_NAME = 'item_name';

    /** @var string - Переменная для рекапчи false */
    public $recaptcha = false;
    const ATTR_RECAPTCHA = 'recaptcha';

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

            [[static::ATTR_RECAPTCHA], ReCaptchaValidator::class, 'secret' => '6LcNnTggAAAAAKiDSyRe0BisZPZqFqtPdRu1LCum', 'uncheckedMessage' => 'Подтвердите что вы не робот.']
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