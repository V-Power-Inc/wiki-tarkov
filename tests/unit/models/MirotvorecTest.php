<?php

namespace models;

use app\models\Mirotvorec;
use app\tests\fixtures\MirotvorecFixture;

/**
 * Unit тесты торговца Терапевт
 *
 * Class MirotvorecTest
 * @package models
 */
class MirotvorecTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы mirotvorec
     * @return array
     */
    public function _fixtures()
    {
        return [
            'mirotvorec' => [
                'class' => MirotvorecFixture::class,
                'dataFile' => codecept_data_dir() . 'mirotvorec.php'
            ]
        ];
    }

    /** Тестируем создание нового маркера */
    public function testCreate()
    {
        $mirotvorec = new Mirotvorec();

        $mirotvorec->tab_number = 1;
        $mirotvorec->title = 'Первый квест';
        $mirotvorec->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $mirotvorec->preview = '/img/admin/resized/classified030318045933.jpg';

        $this->assertTrue($mirotvorec->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $mirotvorec = Mirotvorec::find()->where(['is not', 'id', null])->one();

        $mirotvorec->tab_number = 2;
        $mirotvorec->title = 'Теперь стал вторым квестом';
        $mirotvorec->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $mirotvorec->preview = '/img/admin/resized/zxcCursed050518045933.jpg';

        $this->assertIsInt($mirotvorec->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $mirotvorec = Mirotvorec::find()->one();

        $this->assertNotNull($mirotvorec, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $mirotvorec = Mirotvorec::find()->all();

        $this->assertTrue(count($mirotvorec) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $mirotvorec = Mirotvorec::find()->one()->delete();

        $this->assertIsInt($mirotvorec, 'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $mirotvorec = Mirotvorec::deleteAll();

        $this->assertIsInt($mirotvorec, 'Удаление объекта не случилось, а должно было.');
    }
    
}