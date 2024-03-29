<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2024
 * Time: 21:11
 */

namespace app\common\constants\files;

/**
 * Класс с путями загрузов для изображений проекта
 *
 * Class ImagePathes
 * @package app\common\constants\files\images
 */
final class ImagePathes extends FilePathes
{
    /** @var string - Константа, путь до основных админских изображений */
    public const PATH_MAIN_ADMIN_FILES = 'img/admin/resized/';

    /** @var string - Константа, путь до изображений превьющек кланов */
    public const PATH_FOR_CLANS_FILES = 'img/admin/resized/clans/';

    /** @var string - Константа, путь до изображений ключей от дверей */
    public const PATH_FOR_DOORKEYS_FILES = 'img/admin/doorkeys/';

    /** @var string - Константа, путь до иконок интерактивных карт локаций */
    public const PATH_FOR_LOCATIONS_FILES = 'img/admin/maps/';

    /** @var string - Константа, путь до иконок превьюшек новостей */
    public const PATH_FOR_NEWS_FILES = 'img/admin/news/';
}