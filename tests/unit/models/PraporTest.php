<?php

namespace models;

use app\models\Prapor;
use app\tests\fixtures\PraporFixture;

/**
 * Unit тесты торговца Терапевт
 *
 * Class PraporTest
 * @package models
 */
class PraporTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы prapor
     * @return array
     */
    public function _fixtures() {
        return [
            'prapor' => [
                'class' => PraporFixture::class,
                'dataFile' => codecept_data_dir() . 'prapor.php'
            ]
        ];
    }

    /** Тестируем создание нового маркера */
    public function testCreate()
    {
        $prapor = new Prapor();

        $prapor->tab_number = 1;
        $prapor->title='Первый квест';
        $prapor->content='<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $prapor->preview='/img/admin/resized/classified030318045933.jpg';

        $this->assertTrue($prapor->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $prapor = Prapor::find()->where(['is not','id',null])->one();

        $prapor->tab_number = 2;
        $prapor->title='Теперь стал вторым квестом';
        $prapor->content='<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $prapor->preview='/img/admin/resized/zxcCursed050518045933.jpg';

        $this->assertIsInt($prapor->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $prapor = Prapor::find()->one();

        $this->assertNotNull($prapor, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $prapor = Prapor::find()->all();

        $this->assertTrue(count($prapor) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $prapor = Prapor::find()->one()->delete();

        $this->assertIsInt($prapor,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $prapor = Prapor::deleteAll();

        $this->assertIsInt($prapor,'Удаление объекта не случилось, а должно было.');
    }

}