<?php

namespace models;

use app\models\Mehanic;
use app\tests\fixtures\MehanicFixture;

/**
 * Unit тесты торговца Механик
 *
 * Class MehanicTest
 * @package models
 */
class MehanicTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы mehanic
     * @return array
     */
    public function _fixtures()
    {
        return [
            'mehanic' => [
                'class' => MehanicFixture::class,
                'dataFile' => codecept_data_dir() . 'mehanic.php'
            ]
        ];
    }

    /** Тестируем создание */
    public function testCreate()
    {
        $mehanic = new Mehanic();

        $mehanic->tab_number = 1;
        $mehanic->title = 'Первый квест';
        $mehanic->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $mehanic->preview = '/img/admin/resized/classified030318045933.jpg';

        $this->assertTrue($mehanic->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление */
    public function testUpdate()
    {
        $mehanic = Mehanic::find()->where(['is not', 'id', null])->one();

        $mehanic->tab_number = 2;
        $mehanic->title = 'Теперь стал вторым квестом';
        $mehanic->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $mehanic->preview = '/img/admin/resized/zxcCursed050518045933.jpg';

        $this->assertIsInt($mehanic->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $mehanic = Mehanic::find()->one();

        $this->assertNotNull($mehanic, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $mehanic = Mehanic::find()->all();

        $this->assertTrue(count($mehanic) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $mehanic = Mehanic::find()->one()->delete();

        $this->assertIsInt($mehanic, 'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $mehanic = Mehanic::deleteAll();

        $this->assertIsInt($mehanic, 'Удаление объекта не случилось, а должно было.');
    }

}