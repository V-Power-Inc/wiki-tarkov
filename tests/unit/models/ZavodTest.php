<?php

namespace models;

use app\models\Zavod;
use app\tests\fixtures\ZavodFixture;

/**
 * Unit тесты интерактивных маркеров Завода
 *
 * Class ZavodTest
 * @package models
 */
class ZavodTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы zavod
     * @return array
     */
    public function _fixtures() {
        return [
            'zavod' => [
                'class' => ZavodFixture::class,
                'dataFile' => codecept_data_dir() . 'zavod.php'
            ]
        ];
    }

    /** Тестируем создание нового маркера */
    public function testCreate()
    {
        $zavod = new Zavod();

        $zavod->name = 'Ящик у выхода с локации';
        $zavod->marker_group='Военные ящики';
        $zavod->coords_x='10';
        $zavod->coords_y='-135';
        $zavod->content='<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $zavod->enabled='1';
        $zavod->customicon='/img/admin/beregicons/vorota_3_d.png';
        $zavod->exits_group='Спавн на зеленой лампе';
        $zavod->exit_anyway='1';

        $this->assertTrue($zavod->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $zavod = Zavod::find()->where(['is not','id',null])->one();

        $zavod->name = 'Ящик у выхода 234234с локации';
        $zavod->marker_group='Военн234234ые ящики';
        $zavod->coords_x='10';
        $zavod->coords_y='-135';
        $zavod->content='<p>Это основной выхо34234234д с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $zavod->enabled='0';
        $zavod->customicon='/img/orota_3_d.png';
        $zavod->exits_group='Другое значение';
        $zavod->exit_anyway='0';

        $this->assertIsInt($zavod->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $zavod = Zavod::find()->one();

        $this->assertNotNull($zavod, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $zavod = Zavod::find()->all();

        $this->assertTrue(count($zavod) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $zavod = Zavod::find()->one()->delete();

        $this->assertIsInt($zavod,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $zavod = Zavod::deleteAll();

        $this->assertIsInt($zavod,'Удаление объекта не случилось, а должно было.');
    }

}