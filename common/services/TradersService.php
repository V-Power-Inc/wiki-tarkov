<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 10.08.2022
 * Time: 12:38
 */

namespace app\common\services;

use app\models\Items;
use app\models\Traders;
use yii\db\ActiveRecord;
use Yii;

/**
 * Класс для работы с сущностями торговцев, включая квесты
 *
 * Class TradersService
 * @package app\common\services
 */
final class TradersService
{
    /**
     * По имени торговца, подставляем нужный урл до квестов торговца (Немного хардкода, куда уж без него)
     * Если появится новый торговец с квестами, этот метод нужно будет расширить и в БД в таблицу traders внести
     * данные о новом торговце
     *
     * @param string $trader - имя торговца
     * @return string
     */
    public static function takeApiTasksUrl(string $trader): string
    {
        /** В свиче - по имени торговца, подставляем нужный урл до квестов */
        switch ($trader) {
            case 'Прапор':
                return 'prapor-quests';
            case 'Терапевт':
                return 'terapevt-quests';
            case 'Скупщик':
                return 'skypshik-quests';
            case 'Лыжник':
                return 'lyjnic-quests';
            case 'Миротворец':
                return 'mirotvorec-quests';
            case 'Механик':
                return 'mehanic-quests';
            case 'Барахольщик':
                return 'baraholshik-quests';
            case 'Егерь':
                return 'eger-quests';
            case 'Смотритель':
                return 'seeker-quests';
            case 'Реф':
                return 'ref-quests';
        }

        /** Если в switch не попали - пишем error, так мы узнаем что есть новый торговец и при этом не вылетит ошибка */
        return 'error';
    }

    /**
     * Получаем отсортированный лут и в зависимости от полученного значения
     * возвращаем нужный результат в контроллер
     *
     * TODO: Очень топорная хрень - подлежит изменениям
     *
     * @param Items $form_model
     * @return ActiveRecord[]
     */
    public static function takeResult(Items $form_model): array
    {
        /** Post данные */
        $post = Yii::$app->request->post();

        /** Сетапим атрибуту модели - данные из POST */
        $form_model->questitem = $post[Items::formName][Items::QUESTITEM];

        /** Возвращаем данные в зависимости от фильтров */
        return $form_model->questitem == "Все предметы" ? Items::takeActiveQuestItems() :
            Items::takeQuestItemsByTraderCat(Traders::getTradersList()[$form_model->questitem]);
    }
}