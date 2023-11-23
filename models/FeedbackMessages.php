<?php

namespace app\models;

use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\SafeValidator;
use app\common\helpers\validators\StringValidator;
use yii\db\ActiveRecord;

/**
 * AR класс таблицы формы обратной связи, с которой посетители смогут отправлять фидбек
 *
 * @property int $id - ID primary key
 * @property string $content - Сообщение из формы
 * @property string $date_create - Дата отправки сообщения
 */
class FeedbackMessages extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID = 'id';
    const ATTR_CONTENT = 'content';
    const ATTR_DATE_CREATE = 'date_create';

    /**
     * Название таблицы
     *
     * @return string
     */
    public static function tableName(): string
    {
        return 'feedback_messages';
    }

    /**
     * Массив валидаций атрибутов текущей модели
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            [static::ATTR_CONTENT, RequiredValidator::class],
            [static::ATTR_CONTENT, StringValidator::class],

            [static::ATTR_DATE_CREATE, SafeValidator::class]
        ];
    }

    /**
     * Массив переводов атрибутов текущей модели
     *
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            static::ATTR_ID => 'ID',
            static::ATTR_CONTENT => 'Сообщение из формы',
            static::ATTR_DATE_CREATE => 'Дата создания',
        ];
    }
}