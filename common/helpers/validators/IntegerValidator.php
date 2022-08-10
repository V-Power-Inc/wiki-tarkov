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
 * @package app\common\validators
 */
class IntegerValidator extends NumberValidator {
    const ATTR_MIN            = 'min';
    const ATTR_MAX            = 'max';
    const ATTR_NUMBER_PATTERN = 'numberPattern';
	public $integerOnly = true;
}
