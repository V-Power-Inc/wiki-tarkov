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
final class NumberValidator extends \yii\validators\NumberValidator {
	const ATTR_MIN            = 'min';
	const ATTR_MAX            = 'max';
	const ATTR_NUMBER_PATTERN = 'numberPattern';
}
