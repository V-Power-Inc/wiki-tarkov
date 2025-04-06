<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 14:00
 */

namespace app\common\services;

use app\common\constants\log\ErrorDesc;
use app\common\interfaces\ResponseStatusInterface;
use Yii;
use yii\base\InvalidConfigException;

/**
 * Сервис для получения транслитов для всякого рода потребностей
 * Содержит приличное количество хардкода
 *
 * Class TranslateService
 * @package app\common\services
 */
final class TranslateService implements CommonServiceInterface
{
    /** @var string - Константа пустой строки */
    private const EMPTY_STRING = '';

    /**
     * Метод по полученному параметру создает название карты - возвращает строку
     * Если вхождения не было - вернет пустую строку
     *
     * @param string $map - название карты
     * @return string
     * @throws InvalidConfigException|\yii\db\Exception
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
            case 'Эпицентр':
                return 'epicenter';
            case 'Эпицентр 21+':
                return 'epicenter-21';
            case 'Лабиринт': # Ивентовая карта от 27 марта 2025г. - возможно будет удалена
                return 'labyrinth';
        }

        /** Логируем что пришла новая карта */
        LogService::saveErrorData(
            Yii::$app->request->getUrl(),
            ErrorDesc::TYPE_NEW_API_MAP,
            ErrorDesc::DESC_NEW_API_MAP . $map,
            ResponseStatusInterface::OK_CODE,
        true
        );

        /** Возвращаем null только если не попали не в 1 из кейсов */
        return self::EMPTY_STRING;
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
            'Зрячий' => 'Сектанты',
            'Погоня' => 'Погоня'
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
            case 'Death Knight': // Вероятно будет выпиливаться - сейчас не юзается
                return '<p class="alert alert-danger size-16 sm-vertical-margin-20">Отряд The Goons - <b>состоит из 3-х боссов а именно, Death Knight, Big Pipe и Birdeye</b> - это и есть боссы. Дополнительная свита может включать от 1-2х человек фракции отступники.</p>';
            case 'Глухарь':
                return '<p class="alert alert-danger size-16 sm-vertical-margin-20">Очень хорошо экипированный босс с очень опасной свитой - <b>не рекомендуется вступать в бой на ближних дистанциях.</b> Лучшим решением будет атаковать его на дальних дистанциях и не допускать его приближения к вам.</p>';
            case 'Зрячий':
                return '<p class="alert alert-danger size-16 sm-vertical-margin-20">Обитает на острове на локации Маяк. <br><br> Дорога к боссу также является опасной, т.к. заминирована - как пройти мины можно посмотреть в следующем видео: <b><a href="https://www.youtube.com/watch?v=7WnUtTGrugo" target="_blank" onclick="ym(47100633,\'reachGoal\',\'youtube_check\')">Как пройти на Маяк</a></b></p>';
            case 'Knight':
                return '<p class="alert alert-danger size-16 sm-vertical-margin-20">Лидер "головорезов". Может появляться на разных картах.</p>';
        }

        /** Возвращаем пустую строку, если не попали в switch */
        return self::EMPTY_STRING;
    }

    /**
     * Метод по имени торговца возвращает статичное описание страницы (Для SEO оптимизации)
     *
     * @param string $trader - Имя торговца
     * @return string
     */
    public static function getTraderQuestDesc(string $trader): string
    {
        /** @var $array - Массив со статичными описаниями торговцев (Когда не выбран таб конкретного квеста) */
        $array = [
            'Прапор' => 'Квесты Прапора вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.',
            'Миротворец' => 'Квесты Миротворца были добавлены в Escape from Tarkov в конце декабря 2017 года, теперь и с этим торговцем можно прокачивать репутацию и проходить квесты - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.',
            'Скупщик' => 'Квесты Скупщика вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.',
            'Терапевт' => 'Квесты Терапевта вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.',
            'Лыжник' => 'Квесты Лыжника вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.',
            'Барахольщик' => 'Квесты Барахольщика вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения, если у Вас возникли вопросы, воспользуйтесь нашим онлайн-торговцем из Escape from Tarkov, он свяжется с вами в кратчайшие сроки. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.',
            'Механик' => 'Механик - новый торговец, который был введен в игру Escape from Tarkov в конце января 2018 года. Теперь с этим торговцем также как и с остальными можно прокачивать репутацию, чтобы покупать более редкое оружие и модули. На данной странице представлен полный список квестов с торговцем Механик из онлайн-шутера Escape from Tarkov.',
            'Егерь' => 'Квесты Егеря вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.',
            'Смотритель' => 'Квесты Смотрителя вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.',
            'Реф' => 'Квесты Рефа вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.',
            'Водитель БТР' => 'Квесты Водителя БТР вы можете выбрать в вертикальном меню - выберите интересующий вас квест и ознакомьтесь с информацией о его прохождении и важных моментах в процессе прохождения. <br><br> Информация о квестах постоянно обновляется, поэтому приведенная здесь информация всегда актуальна.'
        ];

        /** Возвращаем значение массива по ключу, если ключа нет - вернем дефолтное описание */
        return $array[$trader] ?? 'Актуальные квесты торговцев Escape from Tarkov';
    }

    /**
     * Метод приводит в читабельный вид фракцию, которая может взять квест
     *
     * @param string $faction - Название фракции
     * @return string
     * @throws InvalidConfigException|\yii\db\Exception
     */
    public static function getQuestFaction(string $faction): string
    {
        /** @var $array - массив с переводами доступных фракций */
        $array = [
            'Any' => 'Bear или Usec',
            'BEAR' => 'Bear',
            'USEC' => 'Usec'
        ];

        /** Если не смогли по ключу найти значение фракции */
        if (empty($array[$faction])) {

            /** Логируем что прилетела новая фракция */
            LogService::saveErrorData(
                Yii::$app->request->getUrl(),
                ErrorDesc::TYPE_NEW_API_FACTION,
                ErrorDesc::DESC_NEW_API_QUEST_FACTION . $faction,
                ResponseStatusInterface::OK_CODE,
                true
            );

            /** Возвращаем необработанный результат */
            return $faction;
        }

        /** Возвращаем значение массива по ключу */
        return $array[$faction];
    }

    /**
     * Метод возвращает русифированный статус квеста, необходимого для взятия другого квеста
     *
     * @param string $status - статус квеста
     * @return string
     * @throws InvalidConfigException|\yii\db\Exception
     */
    public static function getTaskStatus(string $status): string
    {
        $array = [
            'active' => 'в процессе выполнения',
            'complete' => 'завершен',
            'failed' => 'провален'
        ];

        /** Если в массиве по ключу не можем найти элемент */
        if (empty($array[$status])) {

            /** Логируем что прилетело новое состояние квеста */
            LogService::saveErrorData(
                Yii::$app->request->getUrl(),
                ErrorDesc::TYPE_NEW_API_QUEST_STATE,
                ErrorDesc::DESC_NEW_API_QUEST_STATE . $status,
                ResponseStatusInterface::OK_CODE,
            true
            );

            /** Возвращаем значение в необработанном виде */
            return $status;
        }

        /** Возвращаем нужное состояние по ключу */
        return $array[$status];
    }
}