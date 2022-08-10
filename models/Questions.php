<?php

namespace app\models;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $date_create
 * @property int $enabled
 */
class Questions extends \yii\db\ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID          = 'id';
    const ATTR_TITLE       = 'title';
    const ATTR_CONTENT     = 'content';
    const ATTR_DATE_CREATE = 'date_create';
    const ATTR_ENABLED     = 'enabled';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['content'], 'string'],
            [['date_create'], 'safe'],
            [['enabled'], 'integer'],
            [['title'], 'string', 'max' => 500],
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
            static::ATTR_TITLE => 'Название вопроса',
            static::ATTR_CONTENT => 'Ответ на вопрос',
            static::ATTR_DATE_CREATE => 'Дата создания',
            static::ATTR_ENABLED => 'Включен'
        ];
    }
}
