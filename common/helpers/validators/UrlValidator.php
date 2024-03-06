<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.04.2023
 * Time: 22:53
 */

namespace app\common\helpers\validators;

/**
 * Валидатор строки - является ли URL адресом
 *
 * Class UrlValidator
 * @package app\common\helpers\validators
 */
final class UrlValidator extends \yii\validators\UrlValidator
{
    const ATTR_VALID_SCHEMES = 'validSchemes';
}