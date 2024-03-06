<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 05.03.2024
 * Time: 20:58
 */

namespace app\common\services\files;

use app\common\constants\files\ImagePathes;
use app\common\models\forms\ClansForm;
use app\models\Articles;
use app\models\Catskills;
use app\models\Doorkeys;
use app\models\Items;
use app\models\Maps;
use app\models\News;
use app\models\Skills;
use app\models\Traders;
use Imagine\Image\Box;
use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * Сервис для загрузки изображений на сервер с помощью моделей
 *
 * Class ImageService
 * @package app\common\services\files
 */
class ImageService extends FilesService
{
    /**
     * Метод реализует загрузку файла на сервер
     *
     * @param Model $class - Экземпляр класса
     * @param string $attribute - Название атрибута, из которого хотим достать файл
     *
     * @return Model
     */
    public static function uploadFile(Model $class, string $attribute): Model
    {
        /** Получаем загруженный файл из переданного класса и атрибута */
        $fileImg = UploadedFile::getInstance($class, $attribute);

        /** Если смогли достать изображение */
        if ($fileImg !== null) {

            /** В свиче смотрим, какой класс сюда прилетел и в зависимости от кейсов отправляем в свой метод */
            switch (get_class($class)) {

                case Articles::class:
                    return static::uploadArticlesPreview($class, $fileImg);

                case ClansForm::class:
                    return static::uploadClansPreview($class, $fileImg);

                case Maps::class:
                    return static::uploadMapsIcons($class, $fileImg);

                case Doorkeys::class:
                    return static::uploadDoorkeysPreview($class, $fileImg);

                case Catskills::class:
                    return static::uploadCatskillsPreview($class, $fileImg);

                case Items::class:
                    return static::uploadItemsPreview($class, $fileImg);

                case News::class:
                    return static::uploadNewsPreview($class, $fileImg);

                case Skills::class:
                    return static::uploadSkillsPreview($class, $fileImg);

                case Traders::class:
                    return static::uploadTradersPreview($class, $fileImg);
            }
        }

        /** Возвращаем объект класса, что прилетел сюда из параметра */
        return $class;
    }

    /**
     * Метод сохраняет файл превьюшки полезной статьи на сервер
     *
     * @param Articles $class - Объект AR класса полезный статей
     * @param UploadedFile $fileImg - Инстанс загруженного файла
     *
     * @return Model
     */
    private static function uploadArticlesPreview(Articles $class, UploadedFile $fileImg): Model
    {
            /** Сетапим путь до сохранения изображения */
            $catalog = ImagePathes::PATH_MAIN_ADMIN_FILES . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;

            /** Сохраняем файл на сервере по заданному пути */
            $fileImg->saveAs($catalog);

            /** Сохраняем корректное имя изображения для атрибута AR модели */
            $class->preview = self::FILE_PATH_SEPARATOR . $catalog;

            /** Преобразуем качество изображения и его размеры уже на сервере */
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog, ['quality' => 90]);

            /** Возвращаем объект класса, что прилетел сюда из параметра */
            return $class;
    }

    /**
     * Метод сохраняет файл превьюшки клана на сервер, если она не подойдет по размерам, также удалит ее
     *
     * @param ClansForm $class - Объект AR класса полезный статей
     * @param UploadedFile $fileImg - Инстанс загруженного файла
     *
     * @return Model
     */
    private static function uploadClansPreview(ClansForm $class, UploadedFile $fileImg): Model
    {
        /** Сетапим путь до сохранения изображения */
        $catalog = ImagePathes::PATH_FOR_CLANS_FILES . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;

        /** Сохраняем файл на сервере по заданному пути */
        $fileImg->saveAs($catalog);

        /** Сохраняем корректное имя изображения для атрибута AR модели */
        $class->preview = self::FILE_PATH_SEPARATOR . $catalog;

        /** Преобразуем качество изображения и его размеры уже на сервере */
        Image::getImagine()->open($catalog)->save($catalog, ['quality' => 70]);

        /** Проверяем размеры изображения */
        $imginfo = getimagesize($_ENV['DOMAIN_PROTOCOL'] . $_ENV['DOMAIN'] . $class->preview);

        /** Проверяем размеры изображения */
        if ($imginfo[0] !== 100 && $imginfo[1] !== 100) {

            /** Если они некорректны - то удаляем его */
            unlink('./' . $class->preview);

            /** Зануливаем атрибут превьюшки клана */
            $class->preview = null;
        }

        /** Возвращаем объект класса, что прилетел сюда из параметра */
        return $class;
    }

    /**
     * Метод сохраняет файл иконки интерактивной карты на сервер
     *
     * @param Maps $class - Объект AR класса маркеров интерактивных карт
     * @param UploadedFile $fileImg - Инстанс загруженного файла
     *
     * @return Model
     */
    private static function uploadMapsIcons(Maps $class, UploadedFile $fileImg): Model
    {
        /** Сетапим путь до сохранения изображения */
        $catalog = ImagePathes::PATH_FOR_LOCATIONS_FILES . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;

        /** Сохраняем файл на сервере по заданному пути */
        $fileImg->saveAs($catalog);

        /** Сохраняем корректное имя изображения для атрибута AR модели */
        $class->customicon = self::FILE_PATH_SEPARATOR . $catalog;

        /** Преобразуем качество изображения и его размеры уже на сервере */
        Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);

        /** Возвращаем объект класса, что прилетел сюда из параметра */
        return $class;
    }

    /**
     * Метод сохраняет файл иконки ключа на сервер
     *
     * @param Doorkeys $class - Объект AR класса ключей от дверей
     * @param UploadedFile $fileImg - Инстанс загруженного файла
     *
     * @return Model
     */
    private static function uploadDoorkeysPreview(Doorkeys $class, UploadedFile $fileImg): Model
    {
        /** Сетапим путь до сохранения изображения */
        $catalog = ImagePathes::PATH_FOR_DOORKEYS_FILES . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;

        /** Сохраняем файл на сервере по заданному пути */
        $fileImg->saveAs($catalog);

        /** Сохраняем корректное имя изображения для атрибута AR модели */
        $class->preview = self::FILE_PATH_SEPARATOR . $catalog;

        /** Преобразуем качество изображения и его размеры уже на сервере */
        Image::getImagine()->open($catalog)->thumbnail(new Box(64, 64))->save($catalog , ['quality' => 90]);

        /** Возвращаем объект класса, что прилетел сюда из параметра */
        return $class;
    }

    /**
     * Метод сохраняет файл категории умения на сервер
     *
     * @param Catskills $class - Объект AR класса категории умения
     * @param UploadedFile $fileImg - Инстанс загруженного файла
     *
     * @return Model
     */
    private static function uploadCatskillsPreview(Catskills $class, UploadedFile $fileImg): Model
    {
        /** Сетапим путь до сохранения изображения */
        $catalog = ImagePathes::PATH_MAIN_ADMIN_FILES . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;

        /** Сохраняем файл на сервере по заданному пути */
        $fileImg->saveAs($catalog);

        /** Сохраняем корректное имя изображения для атрибута AR модели */
        $class->preview = self::FILE_PATH_SEPARATOR . $catalog;

        /** Преобразуем качество изображения и его размеры уже на сервере */
        Image::getImagine()->open($catalog)->thumbnail(new Box(130, 130))->save($catalog , ['quality' => 90]);

        /** Возвращаем объект класса, что прилетел сюда из параметра */
        return $class;
    }

    /**
     * Метод сохраняет файл иконки справочника лута на сервер
     *
     * @param Items $class - Объект AR класса предмета из справочника лута
     * @param UploadedFile $fileImg - Инстанс загруженного файла
     *
     * @return Model
     */
    private static function uploadItemsPreview(Items $class, UploadedFile $fileImg): Model
    {
        /** Сетапим путь до сохранения изображения */
        $catalog = ImagePathes::PATH_MAIN_ADMIN_FILES . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;

        /** Сохраняем файл на сервере по заданному пути */
        $fileImg->saveAs($catalog);

        /** Сохраняем корректное имя изображения для атрибута AR модели */
        $class->preview = self::FILE_PATH_SEPARATOR . $catalog;

        /** На случай преобразований */
        // Image::getImagine()->open($catalog)->save($catalog);

        /** Возвращаем объект класса, что прилетел сюда из параметра */
        return $class;
    }

    /**
     * Метод сохраняет файл превьюшки новости на сервер
     *
     * @param News $class - Объект AR класса новости
     * @param UploadedFile $fileImg - Инстанс загруженного файла
     *
     * @return Model
     */
    private static function uploadNewsPreview(News $class, UploadedFile $fileImg): Model
    {
        /** Сетапим путь до сохранения изображения */
        $catalog = ImagePathes::PATH_FOR_NEWS_FILES . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;

        /** Сохраняем файл на сервере по заданному пути */
        $fileImg->saveAs($catalog);

        /** Сохраняем корректное имя изображения для атрибута AR модели */
        $class->preview = self::FILE_PATH_SEPARATOR . $catalog;

        /** Преобразуем качество изображения и его размеры уже на сервере */
        Image::getImagine()->open($catalog)->thumbnail(new Box(200, 113))->save($catalog , ['quality' => 90]);

        /** Возвращаем объект класса, что прилетел сюда из параметра */
        return $class;
    }

    /**
     * Метод сохраняет файл превьюшки скила на сервер
     *
     * @param Skills $class - Объект AR класса скила
     * @param UploadedFile $fileImg - Инстанс загруженного файла
     *
     * @return Model
     */
    private static function uploadSkillsPreview(Skills $class, UploadedFile $fileImg): Model
    {
        /** Сетапим путь до сохранения изображения */
        $catalog = ImagePathes::PATH_MAIN_ADMIN_FILES . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;

        /** Сохраняем файл на сервере по заданному пути */
        $fileImg->saveAs($catalog);

        /** Сохраняем корректное имя изображения для атрибута AR модели */
        $class->preview = self::FILE_PATH_SEPARATOR . $catalog;

        /** Преобразуем качество изображения и его размеры уже на сервере */
        Image::getImagine()->open($catalog)->thumbnail(new Box(68, 69))->save($catalog , ['quality' => 90]);

        /** Возвращаем объект класса, что прилетел сюда из параметра */
        return $class;
    }

    /**
     * Метод сохраняет файл превьюшки скила на сервер
     *
     * @param Traders $class - Объект AR класса торговца
     * @param UploadedFile $fileImg - Инстанс загруженного файла
     *
     * @return Model
     */
    private static function uploadTradersPreview(Traders $class, UploadedFile $fileImg): Model
    {
        /** Сетапим путь до сохранения изображения */
        $catalog = ImagePathes::PATH_MAIN_ADMIN_FILES . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;

        /** Сохраняем файл на сервере по заданному пути */
        $fileImg->saveAs($catalog);

        /** Сохраняем корректное имя изображения для атрибута AR модели */
        $class->preview = self::FILE_PATH_SEPARATOR . $catalog;

        /** Преобразуем качество изображения и его размеры уже на сервере */
        Image::getImagine()->open($catalog)->thumbnail(new Box(130, 130))->save($catalog , ['quality' => 90]);

        /** Возвращаем объект класса, что прилетел сюда из параметра */
        return $class;
    }
}