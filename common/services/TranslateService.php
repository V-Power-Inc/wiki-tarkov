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
            case 'Улицы Таркова':
                return 'streets-of-tarkov';
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

    /**
     * Метод хранит в себе тексты с триггерами, которые могут повлечь за собой спавн боссов.
     * Нужен для осуществления переводов английских описаний текстов на русский
     *
     * @return array
     */
    private static function triggerTexts(): array
    {
        return [
            'Bunker Hermetic Door Power Switch' => 'Открыть гермозатвор бункера',
            'D-2 Power Switch' => 'Подача электричества на D-2'
        ];
    }

    /**
     * Метод осуществляет перевод английских названий триггеров на русские, при активации события по вызову босса (SpawnTrigger)
     * Если соответствующего ключа в массиве не было - вернет пустую строку
     *
     * @param string $text - Текст описания триггера, для спавна босса
     * @return string
     */
    public static function setSpawnTrigger(string $text): string
    {
        return static::triggerTexts()[$text] ?? '';
    }

    /**
     * Массив с ключами и переводами на русский фракций боссов, используется с помощью ключа
     * UPD 29-11-2022 - Используется как хардкод, возможно после релиза нового функционала tarkov.dev дела пойдут лучше
     * @link https://github.com/the-hideout/tarkov-dev/issues/273
     *
     * @param string $boss_name - Строка в виде имени босса
     * @return string
     */
    public static function bossesFactions(string $boss_name): string
    {
        $array = [
            'Death Knight' => 'Отступники',
            'Рейдер' => 'Рейдеры',
            'Отступник' => 'Отступники',
            'Зрячий' => 'Сектанты'
        ];

        /** Если нашли ключ в массиве - возвращаем его значение, если нет - возвращаем строку Дикие */
        return $array[$boss_name] ?? 'Дикие';
    }

    /**
     * Метод возвращает строки с хардкод описаниями некоторых боссов (Указания чтобы пользователи лучше понимали информацию)
     * Возвращает html строку с описанием, либо пустую строку, если не попали в switch
     *
     * @param string $boss_name - Строка с именем босса
     * @return string
     */
    public static function bossesAlertInfo(string $boss_name): string
    {
        /** В свитче по названию босса ищем соответствующее ему описание */
        switch ($boss_name) {
            case 'Death Knight':
                return '<p class="alert alert-danger size-16 sm-vertical-margin-20">Отряд The Goons - <b>состоит из 3-х боссов а именно, Death Knight, Big Pipe и Birdeye</b> - это и есть боссы. Дополнительная свита может включать от 1-2х человек фракции отступники.</p>';
            case 'Глухарь':
                return '<p class="alert alert-danger size-16 sm-vertical-margin-20">Очень хорошо экипированный босс с очень опасной свитой - <b>не рекомендуется вступать в бой на ближних дистанциях.</b> Лучшим решением будет атаковать его на дальних дистанциях и не допускать его приближения к вам.</p>';
            case 'Зрячий':
                return '<p class="alert alert-danger size-16 sm-vertical-margin-20">Обитает на острове на локации Маяк, на момент патча <b>0.13.0</b> - шанс спавна <b>100%</b>! При неудавшейся попытке убить босса с первой попытки, он немедленно убьет игрока, кто пытался это сделать.</p>';
        }

        /** Возвращаем пустую строку, если не попали в switch */
        return '';
    }
}