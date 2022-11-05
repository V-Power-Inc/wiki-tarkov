<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 14:00
 */

namespace app\common\services;

/**
 * Сервис для получения транслитов для всякого рода потребностей
 *
 * Class TranslateService
 * @package app\common\services
 */
final class TranslateService
{
    /**
     * Метод по полученному параметру создает название карты - возвращает строку
     * Если вхождения не было - вернет null
     *
     * @param string $map - название карты
     * @return string|null
     */
    public static function mapUrlCreator(string $map): string
    {
        /** В свитче перебираем все известные названия карт и возвращаем транслит в виде строки */
        switch ($map) {
            case 'Таможня':
                return 'tamojnya';
            case 'Завод':
                return 'zavod';
            case 'Развязка':
                return 'razvyazka';
            case 'Маяк':
                return 'lighthouse';
            case 'Резерв':
                return 'rezerv';
            case 'Ночной Завод':
                return 'night-zavod';
            case 'Берег':
                return 'bereg';
            case 'Лаборатория':
                return 'terragroup-laboratory';
            case 'Лес':
                return 'forest';
        }

        /** Возвращаем null только если не попали не в 1 из кейсов */
        return null;
    }

    /**
     * Метод осуществляет возврат русскоязычного названия зоны по русскоязычному ключу массива
     * на всякий случай в result метода реализована проверка на предмет существования ключа массив
     *
     * @param string $zone - имя зоны в локации
     * @return string
     */
    private static function zonesArray(string $zone): string
    {
        /** Массив с переводами зон на русский язык */
        $zonesArray = [
            'ScavBase' => 'Аванпост Диких',
            'Dormitory' => 'Общежития',
            'GasStation' => 'Бензоколонка',
            'Anywhere' => 'Везде',
            'Center' => 'Центр',
            'OLI' => 'OLI',
            'IDEA' => 'IDEA',
            'Goshan' => 'Goshan',
            'IDEAPark' => 'IDEAPark',
            'OLIPark' => 'OLIPark',
            'Blockpost' => 'Блокпост',
            'RoofContainers' => 'Крыша',
            'TreatmentBeach' => 'Лечебный пляж',
            'Chalet' => 'Шале',
            'TreatmentContainers' => 'Лечебные контейнеры',
            'TreatmentRocks' => 'Лечебные скалы',
            'Island' => 'Остров',
            'RoofRocks' => 'Скалы',
            'RoofBeach' => 'Пляж на крыше',
            'Hellicopter' => 'Вертолет',
            'RailStrorage' => 'ЖД станция',
            'PTOR1' => 'ПТУР-1',
            'PTOR2' => 'ПТУР-2',
            'Barrack' => 'Бараки',
            'SubStorage' => 'Подземное хранилище',
            'SubCommand' => 'Командный центр',
            'MeteoStation' => 'Метео-станция',
            'ForestGasStation' => 'Бензоколонка у леса',
            'ForestSpawn' => 'Лес',
            'Port' => 'Порт',
            'GreenHouses' => 'Зеленые дома',
            'Sanatorium1' => 'Западный корпус санатория',
            'Sanatorium2' => 'Восточный корпус санатория',
            'Floor1' => '1 этаж',
            'Floor2' => '2 этаж',
            'Basement' => 'Подвал',
            'WoodCutter' => 'Лесопилка',
            'BrokenVill' => 'Брошенная деревня',
            'ScavBase2' => 'Аванпост Диких',
            'MiniHouse' => 'Дом в лесу'
        ];

        /** Возвращаем результат по ключу массива с проверкой - на случай если значения не будет здесь */
        return !empty($zonesArray[$zone]) ? $zonesArray[$zone] : 'Не определено';
    }

    /**
     * Этот метод осуществляет перевод английских название зон на русские с помощью статичного массива
     *
     * @param array $array - Массив с названиями зон присутвующих в локации
     * @return array
     */
    public static function setZoneNames(array $array): array
    {
        /** Итоговый массив с русскими названиями зон */
        $result = [];

        /** В цикле проходим каждое название зоны и заменяем на русское */
        foreach ($array as $zone) {

            /** В цикле каждое новое название отправляем в новый массив */
            $result[] = static::zonesArray($zone);
        }

        /** Возвращаем конечный массив */
        return $result;
    }

}