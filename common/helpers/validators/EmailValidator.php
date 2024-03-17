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
final class EmailValidator extends \yii\validators\EmailValidator
{
    public const ATTR_PATTERN              = 'pattern';
    public const ATTR_FULL_PATTERN         = 'fullPattern';
    public const ATTR_PATTERN_ASCII        = 'patternASCII';
    public const ATTR_FULL_PATTERN_ASCII   = 'fullPatternASCII';
    public const ATTR_ALLOW_NAME           = 'allowName';
    public const ATTR_CHECK_DNS            = 'checkDNS';
    public const ATTR_ENABLE_IDN           = 'enableIDN';
    public const ATTR_ENABLE_LOCAL_IDN     = 'enableLocalIDN';
}