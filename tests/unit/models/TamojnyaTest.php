<?php

namespace models;

use app\models\Zavod;
use app\tests\fixtures\TamojnyaFixture;

/**
 * Unit тесты интерактивных маркеров Таможни
 *
 * Class TamojnyaTest
 * @package models
 */
class TamojnyaTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы tamojnya
     * @return array
     */
    public function _fixtures() {
        return [
            'tamojnya' => [
                'class' => TamojnyaFixture::class,
                'dataFile' => codecept_data_dir() . 'tamojnya.php'
            ]
        ];
    }

    /** Тестируем создание нового маркера */
    public function testCreate()
    {
        $tamojnya = new Zavod();

        $tamojnya->name = 'Ящик у выхода с локации';
        $tamojnya->marker_group='Военные ящики';
        $tamojnya->coords_x='10';
        $tamojnya->coords_y='-135';
        $tamojnya->content='<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $tamojnya->enabled='1';
        $tamojnya->customicon='/img/admin/beregicons/vorota_3_d.png';
        $tamojnya->exits_group='Спавн на зеленой лампе';
        $tamojnya->exit_anyway='1';

        $this->assertTrue($tamojnya->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $tamojnya = Zavod::find()->where(['is not','id',null])->one();

        $tamojnya->name = 'Ящик у выхода 234234с локации';
        $tamojnya->marker_group='Военн234234ые ящики';
        $tamojnya->coords_x='10';
        $tamojnya->coords_y='-135';
        $tamojnya->content='<p>Это основной выхо34234234д с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $tamojnya->enabled='0';
        $tamojnya->customicon='/img/orota_3_d.png';
        $tamojnya->exits_group='Другое значение';
        $tamojnya->exit_anyway='0';

        $this->assertIsInt($tamojnya->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $tamojnya = Zavod::find()->one();

        $this->assertNotNull($tamojnya, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $tamojnya = Zavod::find()->all();

        $this->assertTrue(count($tamojnya) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $tamojnya = Zavod::find()->one()->delete();

        $this->assertIsInt($tamojnya,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $tamojnya = Zavod::deleteAll();

        $this->assertIsInt($tamojnya,'Удаление объекта не случилось, а должно было.');
    }

}