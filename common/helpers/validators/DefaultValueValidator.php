<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 18:54
 */

namespace app\common\helpers\validators;

/**
 * Валидатор дефолтного значения
 *
 * Class DefaultValueValidator
 * @package app\common\helpers\validators
 */
final class DefaultValueValidator extends \yii\validators\DefaultValueValidator {
    const ATTR_VALUE = 'value';
}