<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 17:12
 */

namespace app\common\helpers\validators;

/**
 * Integer валидатор
 *
 * Class IntegerValidator
 * @package app\common\helpers\validators
 */
final class IntegerValidator extends \yii\validators\NumberValidator
{
    public const ATTR_MIN            = 'min';
    public const ATTR_MAX            = 'max';
    public const ATTR_NUMBER_PATTERN = 'numberPattern';
	public $integerOnly = true;
}
