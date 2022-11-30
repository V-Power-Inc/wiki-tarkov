<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 29.11.2022
 * Time: 23:51
 */

namespace models;

use app\models\Bosses;
use app\tests\fixtures\BossesFixture;

/**
 * Unit тесты для API страниц боссов
 *
 * Class BossesTest
 * @package models
 */
class BossesTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы bosses
     * @return array
     */
    public function _fixtures()
    {
        return [
            'bosses' => [
                'class' => BossesFixture::class,
                'dataFile' => codecept_data_dir() . 'bosses.php'
            ]
        ];
    }

    /** Тестируем создание */
    public function testCreate()
    {
        $boss = new Bosses();

        $boss->map = 'Таможня';
        $boss->bosses = '[{"name":"Death Knight","spawnChance":0.16,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":1}]},{"amount":[{"count":1}]}]},{"name":"Решала","spawnChance":0.1,"spawnTrigger":null,"spawnLocations":[{"name":"Dormitory"},{"name":"GasStation"}],"escorts":[{"amount":[{"count":4}]}]},{"name":"Сектант Жрец","spawnChance":0.02,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":4}]}]}]';
        $boss->active = 1;
        $boss->old = 0;
        $boss->url = 'tamojnya';

        $this->assertTrue($boss->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление */
    public function testUpdate()
    {
        $boss = Bosses::find()->where(['is not', 'id', null])->one();

        $boss->map = 'Таможня33';
        $boss->bosses = '[{"name":"Death Knight","spawnChance":0.16,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":2}]},{"amount":[{"count":1}]},{"amount":[{"count":1}]}]},{"name":"Решала","spawnChance":0.1,"spawnTrigger":null,"spawnLocations":[{"name":"Dormitory"},{"name":"GasStation"}],"escorts":[{"amount":[{"count":4}]}]},{"name":"Сектант Жрец","spawnChance":0.02,"spawnTrigger":null,"spawnLocations":[{"name":"ScavBase"}],"escorts":[{"amount":[{"count":4}]}]}]';
        $boss->active = 0;
        $boss->old = 1;
        $boss->url = 'tamojnya';

        $this->assertIsInt($boss->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $boss = Bosses::find()->one();

        $this->assertNotNull($boss, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $boss = Bosses::find()->all();

        $this->assertTrue(!empty($boss), 'Ожидалось что вернется объект, этого не случилось - что-то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $boss = Bosses::find()->one()->delete();

        $this->assertIsInt($boss, 'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $boss = Bosses::deleteAll();

        $this->assertIsInt($boss, 'Удаление объекта не случилось, а должно было.');
    }
}