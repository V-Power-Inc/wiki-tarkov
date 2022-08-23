<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 23.08.2022
 * Time: 9:12
 */

namespace models;

use app\models\Baraholshik;
use app\tests\fixtures\BaraholshikFixture;

/**
 * Unit тесты торговца Барахольщик
 *
 * Class BaraholshikTest
 * @package models
 */
class BaraholshikTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы baraholshik
     * @return array
     */
    public function _fixtures()
    {
        return [
            'baraholshik' => [
                'class' => BaraholshikFixture::class,
                'dataFile' => codecept_data_dir() . 'baraholshik.php'
            ]
        ];
    }

    /** Тестируем создание */
    public function testCreate()
    {
        $baraholshik = new Baraholshik();

        $baraholshik->tab_number = 1;
        $baraholshik->title = 'Первый квест';
        $baraholshik->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $baraholshik->preview = '/img/admin/resized/classified030318045933.jpg';

        $this->assertTrue($baraholshik->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление */
    public function testUpdate()
    {
        $baraholshik = Baraholshik::find()->where(['is not', 'id', null])->one();

        $baraholshik->tab_number = 2;
        $baraholshik->title = 'Теперь стал вторым квестом';
        $baraholshik->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $baraholshik->preview = '/img/admin/resized/zxcCursed050518045933.jpg';

        $this->assertIsInt($baraholshik->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $baraholshik = Baraholshik::find()->one();

        $this->assertNotNull($baraholshik, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $baraholshik = Baraholshik::find()->all();

        $this->assertTrue(count($baraholshik) == 4, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $baraholshik = Baraholshik::find()->one()->delete();

        $this->assertIsInt($baraholshik, 'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $baraholshik = Baraholshik::deleteAll();

        $this->assertIsInt($baraholshik, 'Удаление объекта не случилось, а должно было.');
    }

}