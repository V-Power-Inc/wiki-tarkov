<?php

namespace app\models;

use app\common\helpers\validators\IntegerValidator;
use app\common\helpers\validators\RequiredValidator;
use app\common\helpers\validators\StringValidator;
use app\models\queries\ErrorLogQuery;
use yii\db\ActiveRecord;

/**
 * Таблица для сохранения в лог всякого рода ошибки со стороны приложения
 *
 * @property int $id ID primary key
 * @property string $type Тип ошибки
 * @property string $url Url, где произошла проблема
 * @property string $description Подробное описание ошибки
 * @property int $error_code Код ошибки
 * @property string $date_create Дата создания записи
 */
class ErrorLog extends ActiveRecord
{
    /** Константы атрибутов Active Record модели */
    const ATTR_ID = 'id';
    const ATTR_TYPE = 'type';
    const ATTR_URL = 'url';
    const ATTR_DESCRIPTION = 'description';
    const ATTR_ERROR_CODE = 'error_code';
    const ATTR_DATE_CREATE = 'date_create';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'error_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [static::ATTR_ID, IntegerValidator::class],

            [static::ATTR_URL, RequiredValidator::class],
            [static::ATTR_URL, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH],

            [static::ATTR_TYPE, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH_HUNDRED],

            [static::ATTR_DESCRIPTION, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH_HUNDRED],

            [static::ATTR_ERROR_CODE, IntegerValidator::class]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_ID => 'ID',
            static::ATTR_TYPE => 'Type',
            static::ATTR_URL => 'Url',
            static::ATTR_DESCRIPTION => 'Description',
            static::ATTR_ERROR_CODE => 'Error Code',
            static::ATTR_DATE_CREATE => 'Date Create',
        ];
    }

    /**
     * Уникальный ActiveQuery для каждой AR модели
     *
     * @return ErrorLogQuery
     */
    public static function find(): ErrorLogQuery
    {
        /** Каждой AR модели свой класс ActiveQuery */
        return new ErrorLogQuery(get_called_class());
    }
}