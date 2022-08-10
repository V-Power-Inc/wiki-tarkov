<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "info".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $preview
 * @property integer $enabled
 * @property string $course
 * @property string $bgstyle
 */


class Info extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID      = 'id';
    const ATTR_TITLE   = 'title';
    const ATTR_CONTENT = 'content';
    const ATTR_PREVIEW = 'preview';
    const ATTR_ENABLED = 'enabled';
    const ATTR_COURSE  = 'course';
    const ATTR_BGSTYLE = 'bgstyle';

    /** @var string $file - Переменная файла превьюшки null */
    public $file = null;
    const FILE = 'file';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['content', 'course'], 'string'],
            [['enabled'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['preview', 'bgstyle'], 'string', 'max' => 200],
            [['file'], 'image'],
        ];
    }

    /**
     * Переводы атрибутов
     *
     * @return array|string[]
     */
    public function attributeLabels(): array
    {
        return [
            static::ATTR_ID => 'ID',
            static::ATTR_TITLE => 'Название',
            static::ATTR_CONTENT => 'Текст сообщения Таркова',
            static::ATTR_PREVIEW => 'Превьюшка биткоина',
            static::ATTR_ENABLED => 'Виджет активен',
            static::ATTR_COURSE => 'Курс биткоина',
            static::ATTR_BGSTYLE => 'Фон сообщения',
            static::FILE => 'Превьюшка биткоина'
        ];
    }

    /*** Загрузка и сохранение превьюшек ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }
}
