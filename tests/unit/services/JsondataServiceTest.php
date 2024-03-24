<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 23.03.2024
 * Time: 15:42
 */

namespace app\tests;

use Codeception\Test\Unit;
use app\common\services\JsondataService;
use tests\_support\FixturesCollection;
use UnitTester;
use yii\db\Exception as DbException;

/**
 * Тестирование сервиса по работе с Json данными
 *
 * Class JsondataServiceTest
 * @package app\common\services
 */
class JsondataServiceTest extends Unit
{
    /** @var UnitTester - Объект класса для тестирования */
    protected UnitTester $tester;

    /**
     * Тестируем поиск ключей в БД
     *
     * @return void
     * @throws DbException
     */
    public function testGetKeysJson()
    {
        /** Грузим фикстуры */
        $this->tester->haveFixtures(FixturesCollection::getDoorkeys());

        /** Дергаем метод с параметров, совпадающим с фикстурами */
        $json = JsondataService::getKeysJson('Ключ');
        $decoded = json_decode($json, true);

        /** Проверяем, что результат не пустой */
        $this->assertNotEmpty($decoded);

        /** Проверяем структуру результата */
        $this->assertArrayHasKey('value', $decoded[0]);
        $this->assertArrayHasKey('name', $decoded[0]);
        $this->assertArrayHasKey('preview', $decoded[0]);
        $this->assertArrayHasKey('url', $decoded[0]);
        $this->assertArrayHasKey('mapgroup', $decoded[0]);
    }

    /**
     * Тестируем поиск лута в БД
     *
     * @return void
     * @throws DbException
     */
    public function testGetLootJson()
    {
        /** Грузим фикстуры */
        $this->tester->haveFixtures(FixturesCollection::getItems());

        /** Дергаем метод с параметров, совпадающим с фикстурами */
        $json = JsondataService::getLootJson('Снайперская винтовка');
        $decoded = json_decode($json, true);

        /** Проверяем, что результат не пустой */
        $this->assertNotEmpty($decoded);

        /** Проверяем структуру результата */
        $this->assertArrayHasKey('value', $decoded[0]);
        $this->assertArrayHasKey('title', $decoded[0]);
        $this->assertArrayHasKey('parentcat_id', $decoded[0]);
        $this->assertArrayHasKey('shortdesc', $decoded[0]);
        $this->assertArrayHasKey('preview', $decoded[0]);
        $this->assertArrayHasKey('url', $decoded[0]);
    }

    /**
     * Тестируем поиск данных в логирующей таблице
     *
     * @return void
     * @throws DbException
     */
    public function testGetSearchApiLogItem()
    {
        /** Грузим фикстуры */
        $this->tester->haveFixtures(FixturesCollection::getApiSearchLogs());

        /** Дергаем метод с параметров, совпадающим с фикстурами */
        $json = JsondataService::getSearchApiLogItem('Ключ');
        $decoded = json_decode($json, true);

        /** Проверяем, что результат не пустой */
        $this->assertNotEmpty($decoded);

        /** Проверяем структуру результата */
        $this->assertArrayHasKey('value', $decoded[0]);
        $this->assertArrayHasKey('title', $decoded[0]);
    }

    /**
     * Тестируем поиск кланов в БД
     *
     * @return void
     * @throws DbException
     */
    public function testGetClansList()
    {
        /** Грузим фикстуры */
        $this->tester->haveFixtures(FixturesCollection::getClans());

        /** Дергаем метод с параметров, совпадающим с фикстурами */
        $json = JsondataService::getClansList('Some');
        $decoded = json_decode($json, true);

        /** Проверяем, что результат не пустой */
        $this->assertNotEmpty($decoded);

        /** Проверяем структуру результата */
        $this->assertArrayHasKey('value', $decoded[0]);
        $this->assertArrayHasKey('title', $decoded[0]);
        $this->assertArrayHasKey('description', $decoded[0]);
        $this->assertArrayHasKey('preview', $decoded[0]);
        $this->assertArrayHasKey('link', $decoded[0]);
        $this->assertArrayHasKey('date_create', $decoded[0]);
    }

    /**
     * Тестируем получение боссов по урлу в БД
     *
     * @return void
     */
    public function testGetBossData()
    {
        /** Грузим фикстуры */
        $this->tester->haveFixtures(FixturesCollection::getBosses());

        /** URL совпадающий с фикстурой */
        $url = 'tamojnya';

        /** Json структура результата очень сложна, проверим что он корректно декодировался */
        $decoded = JsondataService::getBossData($url);

        /** Проверяем, что результат не пустой */
        $this->assertNotEmpty($decoded);
    }
}