<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 12.08.2022
 * Time: 23:47
 */

namespace app\common\services;

use app\models\Items;
use app\models\Traders;
use yii\db\ActiveRecord;

/**
 * Этот класс занимается пробросом данных на страницу квестовых предметов
 *
 * Class TraderService
 * @package app\common\services
 */
final class TraderService
{
    /**
     * Получаем отсортированный лут и в зависимости от полученного значения
     * возвращаем нужный результат в контроллер
     *
     * @param Items $form_model
     * @return ActiveRecord[]
     */
    public static function takeResult(Items $form_model)
    {
        $form_model->questitem = $_POST[Items::formName][Items::QUESTITEM];

        return $result = $form_model->questitem == "Все предметы" ? Items::takeActiveQuestItems() :
            Items::takeQuestItemsByTraderCat(Traders::getTradersList()[$form_model->questitem]);
    }
}