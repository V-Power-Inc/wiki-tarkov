<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 06.04.2023
 * Time: 16:54
 */

namespace app\common\services;

use app\components\CookieComponent;
use Yii;

/**
 * Класс, задающий правильный фон и цвет для HighCharts графиков
 *
 * Class HighChartsService
 * @package app\common\services
 */
final class HighChartsService
{
    /**
     * Метод возвращает правильный цвет стилей для HighCharts графика в зависимости от включенной темы на сайте
     * Сетапит бэкграунд графиков
     *
     * @return string
     */
    public static function getBackgroundByTheme(): string
    {
        /** В зависимости от выбранно темы сайта - вернет правильный цвет для бэкграунда HighCharts при рендере */
        return Yii::$app->request->cookies->has(CookieComponent::NAME_DARK_THEME) ? '#363535' : '#fff';
    }

    /**
     * Метод возвращает правильный цвет стилей для HighCharts графика в зависимости от включенной темы на сайте
     * Сетапит текст графиков
     *
     * @return string
     */
    public static function getTextByTheme(): string
    {
        /** В зависимости от выбранно темы сайта - вернет правильный цвет для текста HighCharts при рендере */
        return Yii::$app->request->cookies->has(CookieComponent::NAME_DARK_THEME) ? '#c4c4c4' : '#333333';
    }
}