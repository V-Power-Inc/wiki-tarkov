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
class FileValidator extends \yii\validators\FileValidator
{
	const  ATTR_EXTENSIONS                   = 'extensions';
	const  ATTR_MIME_TYPES                   = 'mimeTypes';
	const  ATTR_MAX_SIZE                     = 'maxSize';
	const  ATTR_MIN_SIZE                     = 'minSize';
	const  ATTR_MAX_FILES                    = 'maxFiles';
	const  ATTR_CHECK_EXTENSION_BY_MIME_TYPE = 'checkExtensionByMimeType';
	const  ATTR_SKIP_ON_EMPTY                = 'skipOnEmpty';
	const  ATTR_MESSAGE                      = 'message';
}