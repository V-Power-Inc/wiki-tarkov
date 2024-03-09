<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 15:56
 */

namespace app\common\services;

/**
 * Сервис для всякого рода работы с изображениями и получения путей к ним
 *
 * Class ImageService
 * @package app\common\services
 */
final class ImageService
{
    /**
     * Массив с ключами в виде названия карт и значений изображения, которое для них используется
     *
     * @param string $map_name - Название карты
     * @return string
     */
    public static function mapImages(string $map_name): string
    {
        /** Массив с ключами виде названий карт и значениями изображений в виде названия */
        $array = [
            'Таможня' => '/img/maps/karta_tamozhnya_preview.png',
            'Завод' => '/img/maps/zavod_prev.jpg',
            'Ночной Завод' => '/img/maps/zavod_prev.jpg',
            'Развязка' => '/img/maps/razvyazka_small.jpg',
            'Маяк' => '/img/maps/lighthouse.jpg',
            'Берег' => '/img/maps/karta_bereg_preview.png',
            'Лаборатория' => '/img/maps/terra-group.png',
            'Резерв' => '/img/maps/rezerv.jpg',
            'Лес' => '/img/maps/forest_prev.jpg',
            'Улицы Таркова' => '/img/maps/streets-of-tarkov.jpg',
            'Эпицентр' => '/img/maps/epicenter.png'
        ];

        /** Возвращаем значение массива по полученному в виде параметра ключу - если такого нет, возвращаем заглушку */
        return $array[$map_name] ?? '/img/qsch.png';
    }

    /**
     * Массив с ключами в виде названия боссов и значений изображений, которое для них используется
     *
     * @param string $boss - Название босса
     * @return string
     */
    public static function bossImages(string $boss): string
    {
        /** Массив с ключами виде названий боссов и значениями изображений в виде названия */
        $array = [
            'Death Knight' => '/img/bosses/death-knight.jpg',
            'Сектант Жрец' => '/img/bosses/cultist-priest.jpg',
            'Решала' => '/img/bosses/reshala.jpg',
            'Килла' => '/img/bosses/killa.jpg',
            'Штурман' => '/img/bosses/shturman.jpg',
            'Глухарь' => '/img/bosses/glukhar.jpg',
            'Рейдер' => '/img/bosses/raider.jpg',
            'Санитар' => '/img/bosses/sanitar.jpg',
            'Тагилла' => '/img/bosses/tagilla.jpg',
            'Отступник' => '/img/bosses/rogue.jpg',
            'Зрячий' => '/img/bosses/zryachiy.jpg',
            'gifter' => '/img/bosses/gifter.jpg',
            'Погоня' => '/img/bosses/pogonya.png',
            'Кабан' => '/img/bosses/kaban.jpg',
            'Кабан (снайпер)' => '/img/bosses/kaban_sniper.jpg',
            'Santa Claus' => '/img/bosses/gifter.jpg',
            'Колонтай' => '/img/bosses/collontay.jpg'
        ];

        /** Возвращаем значение массива по полученному в виде параметра ключу или изображение вопроса, если босс не найден */
        return $array[$boss] ?? '/img/qsch.png';
    }

    /**
     * Метод возвращает URL адрес изображения по имени торговца
     *
     * @param string $trader - имя торговца
     * @return string
     */
    public static function traderImages(string $trader): string
    {
        /** Массив с ключами в виде имен торговцев и значениями в виде адресов URL изображений */
        $array = [
            'Прапор' => '/img/admin/resized/p2240218062615.jpg',
            'Терапевт' => '/img/admin/resized/terapevt240218063007.jpg',
            'Скупщик' => '/img/admin/resized/skupshik240218063039.jpg',
            'Лыжник' => '/img/admin/resized/lyjnic240218063018.jpg',
            'Миротворец' => '/img/admin/resized/mirotvorec240218063026.jpg',
            'Механик' => '/img/admin/resized/mehanik_icon230218052228.png',
            'Барахольщик' => '/img/admin/resized/barakholshik050518061242.png',
            'Егерь' => '/img/admin/resized/EGER150922040216.jpg',
            'Смотритель' => '/img/torgovcy/small/light_keeper.jpg',
            'Барахолка' => '/img/baraholka.jpg'
        ];

        /** Возвращаем значение по ключу или если его не нашли дефолтную картинку с вопросом */
        return !empty($array[$trader]) ? $array[$trader] : '/img/qsch.png' ;
    }

    /**
     * Метод возвращает дефолтную картинку списка квестов, до того как был выбран какой-то конкретный квест
     *
     * @param string $trader - имя торговца
     * @return string
     */
    public static function questsTraderImages(string $trader): string
    {
        $array = [
            'Прапор' => '/img/torgovcy/prapor-quests/prapor-full.jpg',
            'Терапевт' => '/img/torgovcy/terapevt-quests/terapevt_full.jpg',
            'Скупщик' => '/img/torgovcy/skypshik-quests/skupshik-full.jpg',
            'Лыжник' => '/img/torgovcy/lyjnic-quests/lyjnic_full.jpg',
            'Миротворец' => '/img/torgovcy/mirotvorec-quests/mirotvorec-full.jpg',
            'Механик' => '/img/torgovcy/mehanic-quests/mehanic-full.jpg',
            'Барахольщик' => '/img/torgovcy/baraholshik-quests/baraholshik-full.jpg',
            'Егерь' => '/img/torgovcy/eger.jpeg',
            'Смотритель' => '/img/torgovcy/seeker_full.jpg',
        ];

        /** Возвращаем значение по ключу или если его не нашли дефолтную картинку с вопросом */
        return !empty($array[$trader]) ? $array[$trader] : '/img/qsch.png' ;
    }
}