<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 17:54
 */

namespace app\common\helpers\validators;

/**
 * Safe валидатор
 *
 * Class SafeValidator
 * @package app\common\helpers\validators
 */
final class SafeValidator extends \yii\validators\SafeValidator
{
    public const ATTR_ON = 'on';
}
