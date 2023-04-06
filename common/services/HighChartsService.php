<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 06.04.2023
 * Time: 16:54
 */

namespace app\common\services;

use Yii;

/**
 * Класс для обеспечения работоспобности графиков, которые выводят информацию об истории цен,
 * полученных из API (Функционал для страниц с лутом)
 *
 * Class HighChartsService
 * @package app\common\services
 */
class HighChartsService
{
    /** @var array - Атрибут класса для сырых данных, сюда они залетают при инициализации класса */
    private $unprocessed_data = [];

    /** @var array - Массив с датами изменения цен на предмет */
    public $dates = [];

    /** @var array - Массив с ценами на предмет (За сколько продано по итогу сделки) */
    public $prices = [];

    /**
     * Полученный массив присваиваем приватному атрибуту этого класса
     *
     * HighChartsService constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        /** Задаем необработанный массив атрибуту класса */
        $this->unprocessed_data = $data;

        /** В цикле проходим каждую отметку времени о сделке и задаем их атрибутам текущего класса */
        foreach ($data as $item) {

            /** Пушим дату сделки в результирующий массив */
            $this->dates[] = date('Y-m-d H:i', $item['timestamp'] / 1000) . ' MSK';

            /** Пушим цену сделки в результирующий массив */
            $this->prices[] = $item['price'];
        }
    }

    /**
     * Метод возвращает правильный цвет стилей для HighCharts графика в зависимости от включенной темы на сайте
     * Сетапит бэкграунд графиков
     *
     * @return string
     */
    public static function getBackgroundByTheme(): string
    {
        /** Коллекция кукисов */
        $cookies = Yii::$app->request->cookies;

        /** В зависимости от выбранно темы сайта - вернет правильный цвет для бэкграунда HighCharts при рендере */
        return isset($cookies['dark_theme']) ? '#363535' : '#fff';
    }

    /**
     * Метод возвращает правильный цвет стилей для HighCharts графика в зависимости от включенной темы на сайте
     * Сетапит текст графиков
     *
     * @return string
     */
    public static function getTextByTheme(): string
    {
        /** Коллекция кукисов */
        $cookies = Yii::$app->request->cookies;

        /** В зависимости от выбранно темы сайта - вернет правильный цвет для текста HighCharts при рендере */
        return isset($cookies['dark_theme']) ? '#c4c4c4' : '#333333';
    }
}