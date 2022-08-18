<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 18.08.2022
 * Time: 21:12
 */

namespace models;

use app\models\Forest;
use app\tests\fixtures\ForestFixture;

/**
 * Unit тесты интерактивных маркеров Берега
 *
 * Class BeregTest
 * @package models
 */
class ForestTest extends \Codeception\Test\Unit
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
            'forest' => [
                'class' => ForestFixture::class,
                'dataFile' => codecept_data_dir() . 'forest.php'
            ]
        ];
    }

    /** Тестируем создание нового маркера */
    public function testCreate()
    {
        $forest = new Forest();

        $forest->name = 'Ящик у выхода с локации';
        $forest->marker_group='Военные ящики';
        $forest->coords_x='10';
        $forest->coords_y='-135';
        $forest->content='<p>Это основной выход с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $forest->enabled='1';
        $forest->customicon='/img/admin/beregicons/vorota_3_d.png';
        $forest->exits_group='Спавн на зеленой лампе';
        $forest->exit_anyway='1';

        $this->assertTrue($forest->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление маркера */
    public function testUpdate()
    {
        $forest = Forest::find()->where(['is not','id',null])->one();

        $forest->name = 'Ящик у выхода 234234с локации';
        $forest->marker_group='Военн234234ые ящики';
        $forest->coords_x='10';
        $forest->coords_y='-135';
        $forest->content='<p>Это основной выхо34234234д с локации Завод, если у вас нет ключа от выхода с завода - это ваш единственный способ выйти с карты.</p><p><img alt="Основной выход с локации Завод. Через него выходит основная часть игроков." src="/img/upload/bereg_images/vihod-s-karty.png" style="width:100%" /></p>';
        $forest->enabled='0';
        $forest->customicon='/img/orota_3_d.png';
        $forest->exits_group='Другое значение';
        $forest->exit_anyway='0';

        $this->assertIsInt($forest->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $forest = Forest::find()->one();

        $this->assertNotNull($forest, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $forest = Forest::find()->all();

        $this->assertTrue(count($forest) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $forest = Forest::find()->one()->delete();

        $this->assertIsInt($forest,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $forest = Forest::deleteAll();

        $this->assertIsInt($forest,'Удаление объекта не случилось, а должно было.');
    }

}