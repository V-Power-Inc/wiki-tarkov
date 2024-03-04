<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 11.08.2022
 * Time: 21:15
 */

namespace app\common\services;

use app\models\Doorkeys;
use yii\db\ActiveRecord;

/**
 * Этот класс занимается пробросом данных на страницу ключей
 *
 * Class KeysService
 * @package app\common\services
 */
final class KeysService
{
    /**
     * Получаем отсортированные ключи и в зависимости от полученного значения
     * возвращаем нужный результат в контроллер
     *
     * @param Doorkeys $form_model
     * @return ActiveRecord[]
     */
    public static function takeResult(Doorkeys $form_model): array
    {
        /** Сетапим атрибуту модели - данные из POST */
        $form_model->doorkey = $_POST[Doorkeys::formName][Doorkeys::DOORKEY];

        /** Возвращаем данные в зависимости от фильтров */
        return $form_model->doorkey == "Все ключи" ? Doorkeys::takeActiveKeys() :
            Doorkeys::takeKeysByCategory(Doorkeys::KeysCategories()[$form_model->doorkey]);
    }
}