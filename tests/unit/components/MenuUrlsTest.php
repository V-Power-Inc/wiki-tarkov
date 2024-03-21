<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 20.03.2024
 * Time: 15:08
 */

namespace app\tests\components;

use app\components\menu\MenuUrlsComponent;
use Codeception\Test\Unit;

/**
 * Тестирование компонента, что возвращает различные группы урлов в виде массивов
 *
 * В обычных условиях методы без параметров с точными данными не тестируются, однако урлы в меню могут измениться,
 * эти тесты помогут не забыть о том что массивы должны быть идентичными
 *
 * Class MenuUrlsTest
 * @package app\tests\components
 */
class MenuUrlsTest extends Unit
{
    /**
     * Проверяем массив урлов для ссылок интерактивных карт локаций
     *
     * @return void
     */
    public function testGetMapsUrlArray()
    {
        $expectedUrls = [
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

        $this->assertEquals($expectedUrls, MenuUrlsComponent::getMapsUrlArray());
    }

    /**
     * Проверяем массив урлов для ссылок на торговцев и их квесты
     *
     * @return void
     */
    public function testGetTradersUrlArray()
    {
        $expectedUrls = [
            "/quests-of-traders",
            "/quests-of-traders/prapor-quests",
            "/quests-of-traders/terapevt-quests",
            "/quests-of-traders/skypchik-quests",
            "/quests-of-traders/lyjnic-quests",
            "/quests-of-traders/mirotvorec-quests",
            "/quests-of-traders/eger-quests",
            "/quests-of-traders/mehanic-quests",
            "/quests-of-traders/seeker-quests",
            "/traders/prapor",
            "/traders/terapevt",
            "/traders/lyjnic",
            "/traders/mirotvorec",
            "/traders/mehanic",
            "/traders/skupshik",
            "/traders/baraholshik",
            "/traders/eger"
        ];

        $this->assertEquals($expectedUrls, MenuUrlsComponent::getTradersUrlArray());
    }

    /**
     * Проверяем массив урлов для ссылок умений и категорий
     *
     * @return void
     */
    public function testGetSkillsUrlArray()
    {
        $expectedUrls = [
            "/skills",
            "/skills/physical",
            "/skills/mental",
            "/skills/practical",
            "/skills/combat",
            "/skills/special"
        ];

        $this->assertEquals($expectedUrls, MenuUrlsComponent::getSkillsUrlArray());
    }

    /**
     * Проверяем массив урлов для ссылок иных частей меню
     *
     * @return void
     */
    public function testGetOtherUrlArray()
    {
        $expectedUrls = [
            '/currencies',
            '/questions',
            '/news',
            '/articles',
            '/clans',
            '/add-clan',
            '/table-patrons',
            '/feedback-form'
        ];

        $this->assertEquals($expectedUrls, MenuUrlsComponent::getOtherUlrArray());
    }
}