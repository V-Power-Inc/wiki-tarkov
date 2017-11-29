<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;

/**
 * This is the model class for table "terapevt".
 *
 * @property integer $id
 * @property integer $tab_number
 * @property string $title
 * @property string $content
 * @property string $date_create
 * @property string $date_edit
 * @property string $preview
 */
class Terapevt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'terapevt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tab_number'], 'integer'],
            [['content'], 'string'],
            [['date_create', 'date_edit'], 'safe'],
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
            'tab_number' => 'Сортировка',
            'title' => 'Название квеста',
            'content' => 'Содержание квеста',
            'date_create' => 'Дата создания',
            'date_edit' => 'Дата последнего редактирования',
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
