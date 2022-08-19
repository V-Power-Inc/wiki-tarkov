<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 18.08.2022
 * Time: 20:49
 */

namespace models;

use app\models\Bereg;
use app\tests\fixtures\BeregFixture;

/**
 * Unit тесты интерактивных маркеров Берега
 *
 * Class BeregTest
 * @package models
 */
class BeregTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы bereg
     * @return array
     */
    public function _fixtures() {
        return [
            'bereg' => [
                'class' => BeregFixture::class,
                'dataFile' => codecept_data_dir() . 'bereg.php'
            ]
        ];
    }

    /** Тестируем создание нового маркера */
    public function testCreate()
    {
        $bereg = new Bereg();

        $bereg->name = 'Ящик у выхода с локации';
        $bereg->marker_group='Военные ящики';
        $bereg->coords_x='10';
        $bereg->coords_y='-135';
        $bereg->content='<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $bereg->enabled='1';
        $bereg->customicon='/img/admin/beregicons/vorota_3_d.png';
        $bereg->exits_group='Спавн на зеленой лампе';
        $bereg->exit_anyway='1';

        $this->assertTrue($bereg->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $bereg = Bereg::find()->where(['is not','id',null])->one();

        $bereg->name = 'Ящик у выхода 234234с локации';
        $bereg->marker_group='Военн234234ые ящики';
        $bereg->coords_x='10';
        $bereg->coords_y='-135';
        $bereg->content='<p>Это основной выхо34234234д с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $bereg->enabled='0';
        $bereg->customicon='/img/orota_3_d.png';
        $bereg->exits_group='Другое значение';
        $bereg->exit_anyway='0';

        $this->assertIsInt($bereg->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $bereg = Bereg::findOne(['id' !== null]);

        $this->assertNotNull($bereg, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $bereg = Bereg::find()->all();

        $this->assertTrue(count($bereg) == 4, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $bereg = Bereg::findOne(['id' !== null])->delete();

        $this->assertIsInt($bereg,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $bereg = Bereg::deleteAll();

        $this->assertIsInt($bereg,'Удаление объекта не случилось, а должно было.');
    }

}