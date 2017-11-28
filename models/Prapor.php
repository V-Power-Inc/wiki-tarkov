<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;

/**
 * This is the model class for table "prapor".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $tab_number
 * @property string $date_create
 * @property string $date_edit
 * @property string $preview
 */
class Prapor extends \yii\db\ActiveRecord
{
    public $file=null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prapor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['tab_number'], 'integer'],
            [['date_create', 'date_edit', 'preview'], 'safe'],
            [['file'], 'image'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название квеста',
            'content' => 'Содержимое квеста',
            'tab_number' => 'Сортировка',
            'date_create' => 'Дата создания',
            'date_edit' => 'Дата последнего редактирования',
            'preview' => 'Превью картинка квеста',
            'file' => 'Файл превьюшки',
        ];
    }

    /*** Загрузка и сохранение превьюшек квеста ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }
}
