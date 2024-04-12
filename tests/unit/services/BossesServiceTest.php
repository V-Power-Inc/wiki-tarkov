<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 25.03.2024
 * Time: 9:41
 */

namespace app\tests;

use app\common\services\BossesService;
use Codeception\Test\Unit;

/**
 * Тестируем сервис по работе с боссами из API
 *
 * Class BossesServiceTest
 * @package app\tests
 */
class BossesServiceTest extends Unit
{
    /**
     * Тестируем метод, что по имени босса должен возвращать имена приспешников
     *
     * @return void
     */
    public function testMinionsNamesPrefix()
    {
        /** Проверяем для существующего босса */
        $prefix = BossesService::minionsNamesPrefix('Глухарь');
        $this->assertEquals('Возможны различные варианты', $prefix);

        /** Проверяем для несуществующего босса */
        $prefix = BossesService::minionsNamesPrefix('Неизвестный босс');
        $this->assertEquals('', $prefix);
    }

    /**
     * Проверяем имена босса, в некоторых случаях есть особая обработка
     *
     * @return void
     */
    public function testCheckBossName()
    {
        /** Проверяем для существующего босса */
        $name = BossesService::checkBossName('gifter');
        $this->assertEquals('Санта Клаус', $name);

        /** Проверяем для существующего босса */
        $name = BossesService::checkBossName('bossKolontay');
        $this->assertEquals('Колонтай', $name);

        /** Проверяем для несуществующего босса */
        $name = BossesService::checkBossName('Неизвестный босс');
        $this->assertEquals('Неизвестный босс', $name);
    }
}