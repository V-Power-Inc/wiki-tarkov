<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 18:12
 */

namespace app\common\helpers\validators;

/**
 * Class UniqueValidator
 * @package common\yii\validators
 */
final class UniqueValidator extends \yii\validators\UniqueValidator
{
    public const ATTR_TARGET_CLASS     = 'targetClass';
    public const ATTR_TARGET_ATTRIBUTE = 'targetAttribute';
    public const ATTR_FILTER           = 'filter';
    public const ATTR_MESSAGE          = 'message';
    public const ATTR_COMBO_NOT_UNIQUE = 'comboNotUnique';
    public const ATTR_ON               = 'on';
}