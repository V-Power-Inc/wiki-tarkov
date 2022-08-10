<?php

namespace app\models;

use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Yii;

/**
 * This is the model class for table "skypshik".
 *
 * @property int $id
 * @property int $tab_number
 * @property string $title
 * @property string $content
 * @property string $date_create
 * @property string $date_edit
 * @property string $preview
 */
class Skypshik extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID          = 'id';
    const ATTR_TAB_NUMBER  = 'tab_number';
    const ATTR_TITLE       = 'title';
    const ATTR_CONTENT     = 'content';
    const ATTR_DATE_CREATE = 'date_create';
    const ATTR_DATE_EDIT   = 'date_edit';
    const ATTR_PREVIEW     = 'preview';

    /** @var string $file - Переменная файла превьюшки null  */
    public $file = null;
    const FILE = 'file';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skypshik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tab_number'], 'integer'],
            [['content'], 'string'],
            [['date_create', 'date_edit'], 'safe'],
            [['file'], 'image'],
            [['title', 'preview'], 'string', 'max' => 100],
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
            static::ATTR_TITLE => 'Название квеста',
            static::ATTR_CONTENT => 'Содержимое квеста',
            static::ATTR_TAB_NUMBER => 'Сортировка',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_DATE_EDIT => 'Дата последнего редактирования',
            static::ATTR_PREVIEW => 'Превью картинка квеста',
            static::FILE => 'Файл превьюшки'
        ];
    }

    /*** Загрузка и сохранение превьюшек квеста ***/
    public function uploadPreview() {
        $fileImg = UploadedFile::getInstance($this, 'file');
        if($fileImg !== null) {
            $catalog = 'img/admin/resized/' . $fileImg->baseName . date("dmyhis", strtotime("now")) . '.' . $fileImg->extension;
            $fileImg->saveAs($catalog);
            $this->preview = '/' . $catalog;
            Image::getImagine()->open($catalog)->thumbnail(new Box(300, 200))->save($catalog , ['quality' => 90]);
        }
    }

    /**
     * Получаем квесты данного торговца
     *
     * @return array
     */
    public static function takeQuests(): array
    {
        return static::find()->orderby([static::ATTR_TAB_NUMBER=>SORT_ASC])->cache(Yii::$app->params['cacheTime']['one_hour'])->all();
    }

}
