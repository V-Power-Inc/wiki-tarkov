<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 17:20
 */

namespace app\common\helpers\validators;

/**
 * Валидатор Email адресов
 *
 * Class EmailValidator
 * @package common\yii\validators
 */
class EmailValidator extends \yii\validators\EmailValidator
{
    const ATTR_PATTERN              = 'pattern';
    const ATTR_FULL_PATTERN         = 'fullPattern';
    const ATTR_PATTERN_ASCII        = 'patternASCII';
    const ATTR_FULL_PATTERN_ASCII   = 'fullPatternASCII';
    const ATTR_ALLOW_NAME           = 'allowName';
    const ATTR_CHECK_DNS            = 'checkDNS';
    const ATTR_ENABLE_IDN           = 'enableIDN';
    const ATTR_ENABLE_LOCAL_IDN     = 'enableLocalIDN';
}