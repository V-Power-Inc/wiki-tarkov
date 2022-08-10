<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 18:03
 */

namespace app\common\helpers\validators;

/**
 * Required валидатор
 *
 * Class RequiredValidator
 * @package app\common\validators
 */
class RequiredValidator extends \yii\validators\RequiredValidator {
	const ATTR_ON          = 'on';
	const ATTR_MESSAGE     = 'message';
	const ATTR_WHEN_CLIENT = 'whenClient';
}
