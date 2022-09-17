<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 17.09.2022
 * Time: 12:30
 */

namespace models;

use app\models\Eger;
use app\tests\fixtures\EgerFixture;

/**
 * Unit тесты торговца Егерь
 *
 * Class EgerTest
 * @package models
 */
class EgerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы eger
     * @return array
     */
    public function _fixtures()
    {
        return [
            'eger' => [
                'class' => EgerFixture::class,
                'dataFile' => codecept_data_dir() . 'eger.php'
            ]
        ];
    }

    /** Тестируем создание */
    public function testCreate()
    {
        $eger = new Eger();

        $eger->tab_number = 1;
        $eger->title = 'Первый квест';
        $eger->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $eger->preview = '/img/admin/resized/classified030318045933.jpg';

        $this->assertTrue($eger->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление */
    public function testUpdate()
    {
        $eger = Eger::find()->where(['is not', 'id', null])->one();

        $eger->tab_number = 2;
        $eger->title = 'Теперь стал вторым квестом';
        $eger->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $eger->preview = '/img/admin/resized/zxcCursed050518045933.jpg';

        $this->assertIsInt($eger->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $eger = Eger::find()->one();

        $this->assertNotNull($eger, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $eger = Eger::find()->all();

        $this->assertTrue(count($eger) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $eger = Eger::find()->one()->delete();

        $this->assertIsInt($eger, 'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $eger = Eger::deleteAll();

        $this->assertIsInt($eger, 'Удаление объекта не случилось, а должно было.');
    }
}