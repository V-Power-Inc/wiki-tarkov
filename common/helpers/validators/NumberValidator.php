<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 17:02
 */

namespace app\common\helpers\validators;

/**
 * Числовой валидатор
 *
 * Class NumberValidator
 * @package app\common\helpers\validators
 */
final class NumberValidator extends \yii\validators\NumberValidator
{
    public const ATTR_MIN            = 'min';
    public const ATTR_MAX            = 'max';
    public const ATTR_NUMBER_PATTERN = 'numberPattern';
}
