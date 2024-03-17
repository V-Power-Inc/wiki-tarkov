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
 * @package app\common\helpers\validators
 */
final class RequiredValidator extends \yii\validators\RequiredValidator
{
    public const ATTR_ON          = 'on';
    public const ATTR_MESSAGE     = 'message';
    public const ATTR_WHEN_CLIENT = 'whenClient';
}
