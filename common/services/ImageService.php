<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.11.2022
 * Time: 15:56
 */

namespace app\common\services;

use app\common\constants\log\ErrorDesc;
use app\common\interfaces\ResponseStatusInterface;
use Yii;
use yii\base\InvalidConfigException;

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
     * @throws InvalidConfigException
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

        /** Если такой локации у нас нет */
        if (empty($array[$map_name])) {

            /** Логируем что пришла новая карта */
            LogService::saveErrorData(Yii::$app->request->getUrl(), ErrorDesc::TYPE_NEW_API_MAP, ErrorDesc::DESC_NEW_API_MAP . $map_name, ResponseStatusInterface::OK_CODE);

            /** Возвращаем заглушку */
            return '/img/qsch.png';
        }

        /** Возвращаем значение массива по полученному в виде параметра ключу */
        return $array[$map_name];
    }

    /**
     * Массив с ключами в виде названия боссов и значений изображений, которое для них используется
     *
     * @param string $boss - Название босса
     * @return string
     * @throws InvalidConfigException
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

        /** Если не нашли изображение подходящего босса */
        if (empty($array[$boss])) {

            /** Логируем что есть необработанный босс */
            LogService::saveErrorData(Yii::$app->request->getUrl(), ErrorDesc::TYPE_NEW_API_BOSS, ErrorDesc::DESC_NEW_API_BOSS . $boss, ResponseStatusInterface::OK_CODE);

            /** Возвращаем изображение заглушку */
            return '/img/qsch.png';
        }

        /** Возвращаем значение массива по полученному в виде параметра ключу */
        return $array[$boss];
    }

    /**
     * Метод возвращает URL адрес изображения по имени торговца
     *
     * @param string $trader - имя торговца
     * @return string
     * @throws InvalidConfigException
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

        /** Если не нашли нужное изображение торговца по ключу */
        if (empty($array[$trader])) {

            /** Логируем что есть необработанный торговец */
            LogService::saveErrorData(Yii::$app->request->getUrl(), ErrorDesc::TYPE_NEW_API_TRADER, ErrorDesc::DESC_NEW_API_TRADER . $trader, ResponseStatusInterface::OK_CODE);

            /** Выводим изображение заглушку */
            return '/img/qsch.png';
        }

        /** Возвращаем значение по ключу */
        return $array[$trader];
    }

    /**
     * Метод возвращает дефолтную картинку списка квестов, до того как был выбран какой-то конкретный квест
     *
     * @param string $trader - имя торговца
     * @return string
     * @throws InvalidConfigException
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

        /** Если не нашли нужное изображение торговца по ключу */
        if (empty($array[$trader])) {

            /** Логируем что есть необработанный торговец */
            LogService::saveErrorData(Yii::$app->request->getUrl(), ErrorDesc::TYPE_NEW_API_TRADER, ErrorDesc::DESC_NEW_API_TRADER . $trader, ResponseStatusInterface::OK_CODE);

            /** Выводим изображение заглушку */
            return '/img/qsch.png';
        }

        /** Возвращаем значение по ключу */
        return $array[$trader];
    }
}