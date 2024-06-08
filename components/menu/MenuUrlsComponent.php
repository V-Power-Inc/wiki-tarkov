<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 27.02.2024
 * Time: 15:48
 */

namespace app\components\menu;

/**
 * Класс, для получения массивов урлов для проверки горизонтального меню на активный элемент
 *
 * Class MenuUrlsComponent
 * @package app\components\menu
 */
final class MenuUrlsComponent
{
    /**
     * Массив урлов карт локаций
     *
     * @return string[]
     */
    public static function getMapsUrlArray(): array
    {
        return [
            "/maps",
            "/maps/zavod-location",
            "/maps/bereg-location",
            "/maps/forest-location",
            "/maps/tamojnya-location",
            "/maps/terragroup-laboratory-location",
            "/maps/rezerv-location",
            "/maps/lighthouse-location",
            "/maps/streets-of-tarkov-location",
            "/maps/razvyazka-location",
            "/maps/epicenter"
        ];
    }

    /**
     * Массив урлов торговцев и их квестов
     *
     * @return string[]
     */
    public static function getTradersUrlArray(): array
    {
        return [
            "/quests-of-traders",
            "/quests-of-traders/prapor-quests",
            "/quests-of-traders/terapevt-quests",
            "/quests-of-traders/skypchik-quests",
            "/quests-of-traders/lyjnic-quests",
            "/quests-of-traders/mirotvorec-quests",
            "/quests-of-traders/eger-quests",
            "/quests-of-traders/mehanic-quests",
            "/quests-of-traders/seeker-quests",
            "/quests-of-traders/ref-quests",
            "/traders/prapor",
            "/traders/terapevt",
            "/traders/lyjnic",
            "/traders/mirotvorec",
            "/traders/mehanic",
            "/traders/skupshik",
            "/traders/baraholshik",
            "/traders/eger"
        ];
    }

    /**
     * Массив урлов страниц с умениями
     *
     * @return string[]
     */
    public static function getSkillsUrlArray(): array
    {
        return [
            "/skills",
            "/skills/physical",
            "/skills/mental",
            "/skills/practical",
            "/skills/combat",
            "/skills/special"
        ];
    }

    /**
     * Массив урлов страницы, что находятся в разделе
     *
     * @return string[]
     */
    public static function getOtherUlrArray(): array
    {
        return [
            '/currencies',
            '/questions',
            '/news',
            '/articles',
            '/clans',
            '/add-clan',
            '/table-patrons',
            '/feedback-form'
        ];
    }
}