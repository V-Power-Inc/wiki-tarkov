<?php

namespace app\models;

use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;

/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.01.2023
 * Time: 12:48
 *
 * Этот класс наследуется от AR Clans, нужен исключительно по причине рекапче в AR модели
 * todo: Косяк проектирования
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $preview
 * @property string $link
 * @property string $date_create
 * @property string $date_update
 * @property int $moderated
 */
class ClansForUnit extends Clans
{
    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [static::ATTR_TITLE, RequiredValidator::class],
            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => 100],

            [static::ATTR_DESCRIPTION, RequiredValidator::class],
            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_DATE_UPDATE, SafeValidator::class],

            [static::ATTR_MODERATED, IntegerValidator::class]
        ];
    }
}