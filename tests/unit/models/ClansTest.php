<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.01.2023
 * Time: 12:04
 * 
 * Unit тесты для таблицы Clans (Сделано через промежуточную модель из за рекапчи)
 */

namespace models;

use app\models\ClansForUnit;

/**
 * Class ClansTest
 * @package models
 */
class ClansTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** Тестируем создание нового объекта */
    public function testCreate()
    {
        $clan = new ClansForUnit();

        $clan->title = 'Second clan';
        $clan->description = 'Secondary desc of clan';
        $clan->preview = 'https://sometest.ru/image_prev.png';
        $clan->link = 'https://sometest.ru';
        $clan->moderated = 1;
        $clan->date_create = '2019-03-29 07:17:10';
        
        $this->assertTrue($clan->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $clan = ClansForUnit::find()->where(['is not','id',null])->one();

        $clan->title = 'Changed title';
        $clan->description = 'Changed Secondary desc of clan';
        $clan->preview = 'https://sometest.ru/image_prev_2.png';
        $clan->link = 'https://sometester.ru';
        $clan->moderated = 0;
        
        $this->assertIsInt($clan->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $clan = ClansForUnit::find()->one();

        $this->assertNotNull($clan, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $clan = ClansForUnit::find()->all();

        $this->assertTrue(count($clan) == 1, 'Ожидалось что вернется 1 объект, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $clan = ClansForUnit::find()->one()->delete();

        $this->assertIsInt($clan,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $clan = ClansForUnit::deleteAll();

        $this->assertIsInt($clan,'Удаление объектов не случилось, а должно было.');
    }
}