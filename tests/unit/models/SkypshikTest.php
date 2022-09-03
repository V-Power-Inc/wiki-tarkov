<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 20.08.2022
 * Time: 0:24
 */
namespace models;

use app\models\Skypshik;
use app\tests\fixtures\SkypshikFixture;

/**
 * Unit тесты торговца Скупщик
 *
 * Class SkypshikTest
 * @package models
 */
class SkypshikTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы skypshik
     * @return array
     */
    public function _fixtures()
    {
        return [
            'skypshik' => [
                'class' => SkypshikFixture::class,
                'dataFile' => codecept_data_dir() . 'skypshik.php'
            ]
        ];
    }

    /** Тестируем создание нового маркера */
    public function testCreate()
    {
        $lyjnic = new Skypshik();

        $lyjnic->tab_number = 1;
        $lyjnic->title = 'Первый квест';
        $lyjnic->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $lyjnic->preview = '/img/admin/resized/classified030318045933.jpg';

        $this->assertTrue($lyjnic->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $lyjnic = Skypshik::find()->where(['is not', 'id', null])->one();

        $lyjnic->tab_number = 2;
        $lyjnic->title = 'Теперь стал вторым квестом';
        $lyjnic->content = '<ol><li><span style="font-size:16px">Найти ключ от 303 комнаты общежития</span></li><li><span style="font-size:16px">Найти ключ ЗБ-014</span></li><li><span style="font-size:16px">Найти ключ от КПП военной базы на Таможне</span></li><li><span style="font-size:16px">Найти ключ склада на заправке</span></li><li><span style="font-size:16px">Передайте ключи Терапевту&nbsp;</span></li></ol>';
        $lyjnic->preview = '/img/admin/resized/zxcCursed050518045933.jpg';

        $this->assertIsInt($lyjnic->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $lyjnic = Skypshik::find()->one();

        $this->assertNotNull($lyjnic, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $lyjnic = Skypshik::find()->all();

        $this->assertTrue(count($lyjnic) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $lyjnic = Skypshik::find()->one()->delete();

        $this->assertIsInt($lyjnic, 'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $lyjnic = Skypshik::deleteAll();

        $this->assertIsInt($lyjnic, 'Удаление объекта не случилось, а должно было.');
    }

}