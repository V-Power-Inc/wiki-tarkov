<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 22:27
 */

namespace app\models\forms;

use app\common\helpers\validators\StringValidator;
use yii\base\Model;

/**
 * Форма для осуществления поиска через API и дальнейшая обработка полученных данных
 *
 * Class ApiForm
 * @package app\models\forms
 */
class ApiForm extends Model
{
    /** @var string - имя предмета */
    public $item_name;
    const ATTR_ITEM_NAME = 'item_name';

    // todo: Тут вероятно надо будет еще использовать Рекапчу, чтобы не засрали базу запросами

    /**
     * Правила валидации модели
     *
     * @return array
     */
    public function rules()
    {
        return [
            [static::ATTR_ITEM_NAME, StringValidator::class, StringValidator::ATTR_MAX => StringValidator::VARCHAR_LENGTH]
        ];
    }

    /**
     * Переводы атрибутов текущей модели
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            static::ATTR_ITEM_NAME => 'Название предмета'
        ];
    }
}