<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2024
 * Time: 21:02
 */

namespace app\common\constants\files;

use app\common\interfaces\FilePathConstsInterface;

/**
 * Промежуточный класс для наследования - по работе с файлами (Наследники хранят в себе различные константы путей до файлов)
 *
 * Class FilePathes
 * @package app\common\constants\files
 */
abstract class FilePathes implements FilePathConstsInterface
{
    /** @var string - Базовая папка до изображений на проекте */
    protected const IMG_BASE_PATH = 'img/';
}