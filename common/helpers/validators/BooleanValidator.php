<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.05.2023
 * Time: 11:54
 */

namespace app\common\helpers\validators;

/**
 * Валидатор boolean значений
 *
 * Class BooleanValidator
 * @package app\common\helpers\validators
 */
class BooleanValidator extends \yii\validators\BooleanValidator
{
    const ATTR_STRICT = 'strict';
}