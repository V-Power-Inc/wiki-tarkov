<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 18:12
 */

namespace app\common\validators;

/**
 * Class UniqueValidator
 * @package common\yii\validators
 */
class UniqueValidator extends \yii\validators\UniqueValidator {
	const ATTR_TARGET_CLASS     = 'targetClass';
	const ATTR_TARGET_ATTRIBUTE = 'targetAttribute';
	const ATTR_FILTER           = 'filter';
	const ATTR_MESSAGE          = 'message';
	const ATTR_COMBO_NOT_UNIQUE = 'comboNotUnique';
	const ATTR_ON               = 'on';
}