<?php

namespace models;

use app\models\Terapevt;
use app\tests\fixtures\TerapevtFixture;

/**
 * Unit тесты интерактивных маркеров Завода
 *
 * Class TerapevtTest
 * @package models
 */
class TerapevtTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы terapevt
     * @return array
     */
    public function _fixtures() {
        return [
            'terapevt' => [
                'class' => TerapevtFixture::class,
                'dataFile' => codecept_data_dir() . 'terapevt.php'
            ]
        ];
    }

    /** Тестируем создание нового маркера */
    public function testCreate()
    {
        $terapevt = new Terapevt();

        $terapevt->tab_number = 1;
        $terapevt->title='Первый квест терапевта';
        $terapevt->content='<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $terapevt->preview='/img/admin/resized/classified030318045933.jpg';

        $this->assertTrue($terapevt->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $terapevt = Terapevt::find()->where(['is not','id',null])->one();

        $terapevt->tab_number = 2;
        $terapevt->title='Теперь стал вторым квестом';
        $terapevt->content='<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $terapevt->preview='/img/admin/resized/zxcCursed050518045933.jpg';

        $this->assertIsInt($terapevt->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $terapevt = Terapevt::find()->one();

        $this->assertNotNull($terapevt, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $terapevt = Terapevt::find()->all();

        $this->assertTrue(count($terapevt) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $terapevt = Terapevt::find()->one()->delete();

        $this->assertIsInt($terapevt,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $terapevt = Terapevt::deleteAll();

        $this->assertIsInt($terapevt,'Удаление объекта не случилось, а должно было.');
    }

}