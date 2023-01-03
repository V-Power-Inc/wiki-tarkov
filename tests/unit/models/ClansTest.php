<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 03.01.2023
 * Time: 12:04
 * 
 * Unit тесты для таблицы Clans
 */

namespace models;

use app\models\Clans;
use app\tests\fixtures\ClansFixture;

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

    /**
     * Фикстуры для таблицы clans
     * @return array
     */
    public function _fixtures() {
        return [
            'clans' => [
                'class' => ClansFixture::class,
                'dataFile' => codecept_data_dir() . 'clans.php'
            ]
        ];
    }

    /** Тестируем создание нового объекта */
    public function testCreate()
    {
        $clan = new Clans();

        $clan->title = 'Second clan';
        $clan->description = 'Secondary desc of clan';
        $clan->preview = 'https://sometest.ru/image_prev.png';
        $clan->link = 'https://sometest.ru';
        $clan->moderated = 1;
        
        $this->assertTrue($clan->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $clan = Clans::find()->where(['is not','id',null])->one();

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
        $clan = Clans::find()->one();

        $this->assertNotNull($clan, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $clan = Clans::find()->all();

        $this->assertTrue(count($clan) == 1, 'Ожидалось что вернется 1 объект, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $clan = Clans::find()->one()->delete();

        $this->assertIsInt($clan,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $clan = Clans::deleteAll();

        $this->assertIsInt($clan,'Удаление объекта не случилось, а должно было.');
    }
}