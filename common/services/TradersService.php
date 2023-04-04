<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 10.08.2022
 * Time: 12:38
 */

namespace app\common\services;

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
    public static function takeApiTasks(string $trader): string
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
        }

        /** Если в switch не попали - пишем error, так мы узнаем что есть новый торговец и при этом не вылетит ошибка */
        return 'error';
    }
}