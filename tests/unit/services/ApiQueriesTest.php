<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 19.03.2024
 * Time: 14:39
 */

namespace app\tests\services;

use app\common\services\ApiQueries;
use Codeception\Test\Unit;

/**
 * Тестирование сервиса сетапа запросов для API
 *
 * Class ApiQueriesTest
 * @package app\tests\services
 */
class ApiQueriesTest extends Unit
{
    /**
     * Тестируем сетап запроса для получения боссов
     *
     * @return void
     */
    public function testSetBossesQuery()
    {
        $apiQueries = new ApiQueries();
        $query = $apiQueries->setBossesQuery();

        $this->assertIsString($query);
        $this->assertNotEmpty($query);
    }

    /**
     * Тестируем сетап значения запроса для получения данных различных предметов по названию
     *
     * @return void
     */
    public function testSetItemQuery()
    {
        $apiQueries = new ApiQueries();
        $itemName = "СВ-98";
        $query = $apiQueries->setItemQuery($itemName);

        $this->assertIsString($query);
        $this->assertNotEmpty($query);
    }

    /**
     * Тестируем сетап запроса для получения информации о квестах
     *
     * @return void
     */
    public function testSetTasksQuery()
    {
        $apiQueries = new ApiQueries();
        $query = $apiQueries->setTasksQuery();

        $this->assertIsString($query);
        $this->assertNotEmpty($query);
    }

    /**
     * Тестируем сетап запроса для получения информации по ценам на предмет
     *
     * @return void
     */
    public function testSetGraphsItemQuery()
    {
        $apiQueries = new ApiQueries();
        $itemId = "СВ-98";
        $query = $apiQueries->setGraphsItemQuery($itemId);

        $this->assertIsString($query);
        $this->assertNotEmpty($query);
    }

    /**
     * Тестируем сетап запроса для получения информации по ID конкретного предмета
     *
     * @return void
     */
    public function testSetSingleItemQuery()
    {
        $apiQueries = new ApiQueries();
        $itemId = "560837154bdc2da74d8b4568";
        $query = $apiQueries->setSingleItemQuery($itemId);

        $this->assertIsString($query);
        $this->assertNotEmpty($query);
    }
}