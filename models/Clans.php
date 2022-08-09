<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "clans".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $preview
 * @property string $link
 * @property string $date_create
 * @property string $date_update
 * @property int $moderated
 */
class Clans extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID          = 'id';
    const ATTR_TITLE       = 'title';
    const ATTR_DESCRIPTION = 'description';
    const ATTR_PREVIEW     = 'preview';
    const ATTR_LINK        = 'link';
    const ATTR_DATE_CREATE = 'date_create';
    const ATTR_DATE_UPDATE = 'date_update';
    const ATTR_MODERATED   = 'moderated';

    public $searchclan;
    public $file;
    public $reCaptcha = false;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['link'], 'string'],
            [['searchclan'], 'string'],
            [['searchclan'], 'safe'],
            [['date_create'], 'safe'],
            [['date_update'], 'safe'],
            [['moderated'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 300],
            [['preview'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::class, 'secret' => '6LeP7D0UAAAAAKyqeAm_ttorHJGS99_gQJ6Fo5me', 'uncheckedMessage' => 'Подтвердите что вы не бот.']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название клана',
            'description' => 'Краткое описание клана',
            'preview' => 'Превью клана',
            'file' => 'Превью клана',
            'link' => 'Ссылка на сообщество клана',
            'date_create' => 'Дата регистрации',
            'moderated' => 'Модерация пройдена',
            'reCaptcha' => 'Защита от спама',
            'searchclan' => 'Поиска клана по названию',
            'date_update' => 'Дата обновления'
        ];
    }

    /*** Загрузка и сохранение логотипов кланов ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {

            $catalog = 'img/admin/resized/clans/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->save($catalog , ['quality' => 70]);

            $imginfo = getimagesize('https://'.$_SERVER['SERVER_NAME'].$this->preview);

            // Проверяем размеры изображения, если они некорректны - то удаляем его.
            if($imginfo[0] !== 100 && $imginfo[1] !== 100) {
                unlink('./'.$this->preview);
                return false;
            }

        }
    }
}
