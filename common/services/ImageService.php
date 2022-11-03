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
            'Лес' => '/img/maps/forest_prev.jpg'
        ];

        /** Возвращаем значение массива по полученному в виде параметра ключу */
        return $array[$map_name];
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
        ];

        /** Возвращаем значение массива по полученному в виде параметра ключу */
        return $array[$boss];
    }
}