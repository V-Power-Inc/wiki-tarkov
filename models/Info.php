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
    
    public $file;
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
    public function rules()
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'content' => 'Текст сообщения Таркова',
            'preview' => 'Превьюшка биткоина',
            'enabled' => 'Виджет активен',
            'course' => 'Курс биткоина',
            'bgstyle' => 'Фон сообщения',
            'file' => 'Превьюшка биткоина',
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
