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
                return '<p class="alert alert-danger size-16 sm-vertical-margin-20">Обитает на острове на локации Маяк. <br><br> Дорога к боссу также является опасной, т.к. заминирована - как пройти мины можно посмотреть в следующем видео: <b><a href="https://www.youtube.com/watch?v=7WnUtTGrugo" target="_blank" onclick="ym(47100633,\'reachGoal\',\'youtube_check\')">Как пройти на Маяк</a></b></p>';
        }

        /** Возвращаем пустую строку, если не попали в switch */
        return '';
    }
}