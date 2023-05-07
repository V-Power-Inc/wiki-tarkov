<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.05.2023
 * Time: 12:20
 */

namespace app\common\helpers\validators;

use himiklab\yii2\recaptcha\ReCaptchaValidator2;

/**
 * Класс прослойка для рекапча валидатора himiklab
 *
 * Class ReCaptchaValidator
 * @package app\common\helpers\validators
 */
class ReCaptchaValidator extends ReCaptchaValidator2
{
    /** @var string - Доступ к атрибуту секрета */
    const ATTR_SECRET = 'secret';

    /** @var string - Доступ к атрибуту, сообщение, если капчка не проверена */
    const ATTR_UNCHECKED_MESSAGE = 'uncheckedMessage';
}