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
 * @package app\common\helpers\validators
 */
final class ExistValidator extends \yii\validators\ExistValidator
{
    public const ATTR_TARGET_CLASS              = 'targetClass';
    public const ATTR_TARGET_ATTRIBUTE          = 'targetAttribute';
    public const ATTR_TARGET_RELATION           = 'targetRelation';
    public const ATTR_FILTER                    = 'filter';
    public const ATTR_ALLOW_ARRAY               = 'allowArray';
    public const ATTR_TARGET_ATTRIBUTE_JUNCTION = 'targetAttributeJunction';
    public const ATTR_FORCE_MASTER_DB           = 'forceMasterDb';
    public const ATTR_ON                        = 'on';
    public const ATTR_MESSAGE                   = 'message';
    public const ATTR_SKIP_ON_ERROR			 = 'skipOnError';
}