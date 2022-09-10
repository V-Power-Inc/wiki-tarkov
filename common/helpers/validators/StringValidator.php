<?php
/**
* Created by PhpStorm.
* User: PC_Principal
* Date: 07.08.2022
* Time: 18:30
*/

namespace app\common\helpers\validators;

/**
 * Строковый валидатор
 *
 * Class StringValidator
 * @package app\common\helpers\validators
 */
class StringValidator extends \yii\validators\StringValidator {
	const ATTR_MIN       = 'min';
	const ATTR_MAX       = 'max';
	const ATTR_LENGTH    = 'length';
	const ATTR_ON        = 'on';
	const ATTR_TOO_SHORT = 'tooShort';
	const ATTR_TOO_LONG  = 'tooLong';

	const VARCHAR_LENGTH = 255;
}
