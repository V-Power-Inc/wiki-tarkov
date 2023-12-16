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

	/** @var int - Длина строки 500 символов */
	const VARCHAR_LENGTH_FIVE_HINDRED = 500;

	/** @var int - Длина строки 255 символов */
	const VARCHAR_LENGTH = 255;

    /** @var int - Длина строки 100 символов */
	const VARCHAR_LENGTH_HUNDRED = 100;

    /** @var int - Длина строки 50 символов */
	const VARCHAR_LENGTH_FIFTY = 50;
}