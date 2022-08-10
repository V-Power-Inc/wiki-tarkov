<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 17:32
 */

namespace app\common\helpers\validators;

/**
 * Валидатор существования ExistValidator
 *
 * Class ExistValidator
 * @package app\common\validators
 */
class ExistValidator extends \yii\validators\ExistValidator {
	const ATTR_TARGET_CLASS              = 'targetClass';
	const ATTR_TARGET_ATTRIBUTE          = 'targetAttribute';
	const ATTR_TARGET_RELATION           = 'targetRelation';
	const ATTR_FILTER                    = 'filter';
	const ATTR_ALLOW_ARRAY               = 'allowArray';
	const ATTR_TARGET_ATTRIBUTE_JUNCTION = 'targetAttributeJunction';
	const ATTR_FORCE_MASTER_DB           = 'forceMasterDb';
	const ATTR_ON                        = 'on';
	const ATTR_MESSAGE                   = 'message';
	const ATTR_SKIP_ON_ERROR			 = 'skipOnError';
}