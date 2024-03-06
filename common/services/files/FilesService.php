<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2024
 * Time: 20:51
 */

namespace app\common\services\files;

use yii\base\Model;

/**
 * Абстрактный класс для реализаций загрузки файла на сервер
 *
 * Class FilesService
 * @package app\common\services\files
 */
abstract class FilesService
{
    /**
     * Метод должен реализовывать загрузку изображения на сервер и возвращать объект модели, которая ранее
     * была передана сюда в качестве первого параметра
     *
     * @param Model $class - Экземпляр класса
     * @param string $attribute - Название атрибута, из которого хотим достать файл
     *
     * @return Model
     */
    abstract public static function uploadFile(Model $class, string $attribute): Model;
}