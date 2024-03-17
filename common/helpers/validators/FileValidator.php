<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 07.08.2022
 * Time: 17:57
 */

namespace app\common\helpers\validators;

/**
 * Файловый валидатор
 *
 * Class FileValidator
 * @package app\common\helpers\validators
 */
final class FileValidator extends \yii\validators\FileValidator
{
    public const  ATTR_EXTENSIONS                   = 'extensions';
    public const  ATTR_MIME_TYPES                   = 'mimeTypes';
    public const  ATTR_MAX_SIZE                     = 'maxSize';
    public const  ATTR_MIN_SIZE                     = 'minSize';
    public const  ATTR_MAX_FILES                    = 'maxFiles';
    public const  ATTR_CHECK_EXTENSION_BY_MIME_TYPE = 'checkExtensionByMimeType';
    public const  ATTR_SKIP_ON_EMPTY                = 'skipOnEmpty';
    public const  ATTR_MESSAGE                      = 'message';
}