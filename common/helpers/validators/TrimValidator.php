<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 18:15
 */

namespace app\common\helpers\validators;

use yii\validators\FilterValidator;

/**
 * Обрезающий символы валидатор
 *
 * Class TrimValidator
 * @package app\common\helpers\validators
 */
final class TrimValidator extends FilterValidator {
    public $filter      = 'trim';
    public $skipOnEmpty = true;
}
