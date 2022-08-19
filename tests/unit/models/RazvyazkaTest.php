<?php

namespace models;

use app\models\Zavod;
use app\tests\fixtures\RazvyazkaFixture;

/**
 * Unit тесты интерактивных маркеров Завода
 *
 * Class RazvyazkaTest
 * @package models
 */
class RazvyazkaTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы razvyazka
     * @return array
     */
    public function _fixtures() {
        return [
            'razvyazka' => [
                'class' => RazvyazkaFixture::class,
                'dataFile' => codecept_data_dir() . 'razvyazka.php'
            ]
        ];
    }

    /** Тестируем создание нового маркера */
    public function testCreate()
    {
        $razvyazka = new Zavod();

        $razvyazka->name = 'Ящик у выхода с локации';
        $razvyazka->marker_group='Военные ящики';
        $razvyazka->coords_x='10';
        $razvyazka->coords_y='-135';
        $razvyazka->content='<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $razvyazka->enabled='1';
        $razvyazka->customicon='/img/admin/beregicons/vorota_3_d.png';
        $razvyazka->exits_group='Спавн на зеленой лампе';
        $razvyazka->exit_anyway='1';

        $this->assertTrue($razvyazka->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $razvyazka = Zavod::find()->where(['is not','id',null])->one();

        $razvyazka->name = 'Ящик у выхода 234234с локации';
        $razvyazka->marker_group='Военн234234ые ящики';
        $razvyazka->coords_x='10';
        $razvyazka->coords_y='-135';
        $razvyazka->content='<p>Это основной выхо34234234д с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $razvyazka->enabled='0';
        $razvyazka->customicon='/img/orota_3_d.png';
        $razvyazka->exits_group='Другое значение';
        $razvyazka->exit_anyway='0';

        $this->assertIsInt($razvyazka->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $razvyazka = Zavod::find()->one();

        $this->assertNotNull($razvyazka, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $razvyazka = Zavod::find()->all();

        $this->assertTrue(count($razvyazka) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $razvyazka = Zavod::find()->one()->delete();

        $this->assertIsInt($razvyazka,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $razvyazka = Zavod::deleteAll();

        $this->assertIsInt($razvyazka,'Удаление объекта не случилось, а должно было.');
    }

}