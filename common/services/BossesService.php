<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 30.11.2022
 * Time: 17:18
 */

namespace app\common\services;

/**
 * Сервис по работе с боссами, используется в целях соответствия сайта спросу посетителей
 * API не хранит все необходимые атрибуты в себе, до тех пор, пока она этого не умеет - этот класс будет
 * использоваться как хардкод решение для отображения HP у боссов, а также имен их свиты. Возможно впоследствии будет
 * добавлен дополнительный функционал но если API будет развиваться, этот класс будет ликвидирован
 *
 * Версия ПО от 22 февраля 2023г.
 *
 * @link https://github.com/the-hideout/tarkov-dev/issues/273 - подробнее о проблемах API в треде разработчиков
 *
 * Class BossesService
 * @package app\common\services
 */
final class BossesService extends AbstractItemsApiService
{
    /**
     * Метод хранит ключи в виде названий боссов и значения в виде количества здоровья босса
     *
     * @return array
     */
    public static function healthBosses(): array
    {
        return [
            'Death Knight' => 1120,
            'Knight' => 1120,
            'Решала' => 727,
            'Сектант Жрец' => 850,
            'Тагилла' => 1220,
            'Килла' => 890,
            'Отступник' => 770,
            'Глухарь' => 1010,
            'Рейдер' => 750,
            'Санитар' => 1270,
            'Штурман' => 812,
            'gifter' => 727,
            'Зрячий' => 1305,
            'Погоня' => 755,
            'Кабан' => 1300,
            'Кабан (снайпер)' => 710,
            'Santa Claus' => 1040,
            'Колонтай' => 1055,
            'Партизан' => 950,
            'Shadow of Tagilla' => 1305,
            'Vengeful Killa' => 960,
            'Shadow of Tagilla Disciple' => 1220,
        ];
    }

    /**
     * Метод возвращает по ключу, возможные значения свиты у боссов
     *
     * @param string $boss_name - Строка, имя босса
     * @return string
     */
    public static function minionsNamesPrefix(string $boss_name): string
    {
        /** Массив с вариациями имен или префиксов свиты */
        $array = [
            'Death Knight' => 'Big pipe, Birdeye, у остальных возможны различные варианты',
            'Решала' => 'Заводской',
            'Санитар' => 'Возможны различные варианты',
            'Глухарь' => 'Возможны различные варианты',
            'Штурман' => 'Светлоозерский'
        ];

        /** Возвращаем либо результат по ключу, либо пустую строку */
        return $array[$boss_name] ?? '';
    }

    /**
     * Метод проверяет названия некоторых боссов и переводит их на русский
     * Это связано с тем, что api tarkov.dev не всегда успевают в краткие сроки обработать данные
     * Первые дни после вайпов - данные прилетают довольные сырые
     *
     * Всегда возвращает строку (Имя босса)
     *
     * @param string $boss_name - Имя босса
     *
     * @return string
     */
    public static function checkBossName(string $boss_name): string
    {
        /** Если у босса имя gifter или Santa Claus */
        if (($boss_name == 'gifter' || $boss_name == 'Santa Claus')) {

            /** Переводим на русский */
            $boss_name = 'Санта Клаус';
        }

        /** Если у босса имя bossKolontay или Kollontay (Api переодически возвращает разные названия) */
        if ($boss_name == 'bossKolontay' || $boss_name == 'Kollontay') {

            /** Переводим на русский */
            $boss_name = 'Колонтай';
        }

        /** Возвращаем строку с именем босса */
        return $boss_name;
    }
}