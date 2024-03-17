<?php

namespace app\models;

use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\StringValidator;
use app\models\queries\QuestionsQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $date_create
 * @property int $enabled
 */
class Questions extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    public const ATTR_ID          = 'id';
    public const ATTR_TITLE       = 'title';
    public const ATTR_CONTENT     = 'content';
    public const ATTR_DATE_CREATE = 'date_create';
    public const ATTR_ENABLED     = 'enabled';

    /** Константы True/False для различных поисков */
    public const TRUE  = 1;
    public const FALSE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * Массив валидаций этой модели
     *
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_TITLE, RequiredValidator::class],
            [static::ATTR_TITLE, StringValidator::class, StringValidator::ATTR_MAX => 500],

            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class],

            [static::ATTR_ENABLED, IntegerValidator::class]
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

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return QuestionsQuery
     */
    public static function find(): QuestionsQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new QuestionsQuery(get_called_class());
    }
}