<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 23.08.2022
 * Time: 9:12
 */

namespace models;

use app\models\Tasks;
use app\tests\fixtures\TasksFixture;

/**
 * Unit тесты квестов из API
 * Раньше это было Unit тестирование таблицы Барахольщика, поэтому квесты тестируем по его примеру
 *
 * Class TasksTest
 * @package models
 */
class TasksTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы tasks
     * @return array
     */
    public function _fixtures()
    {
        return [
            'baraholshik' => [
                'class' => TasksFixture::class,
                'dataFile' => codecept_data_dir() . 'tasks.php'
            ]
        ];
    }

    /** Тестируем создание */
    public function testCreate()
    {
        $baraholshik = new Tasks();

        $baraholshik->quest = 'Первый квест';
        $baraholshik->trader_name = 'Барахольщик';
        $baraholshik->trader_icon = 'https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp';
        $baraholshik->json = '{"name":"Секрет успеха","factionName":"Any","minPlayerLevel":26,"objectives":[{"type":"findQuestItem","description":"Найти Книгу о технологии изготовления одежды - Часть 1 на Развязке","optional":false},{"type":"giveQuestItem","description":"Передать первую книгу","optional":false},{"type":"findQuestItem","description":"Найти Книгу о технологии изготовления одежды - Часть 2 на Развязке","optional":false},{"type":"giveQuestItem","description":"Передать вторую книгу","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Шить - не тужить - Часть 2"},"status":["complete"]}],"experience":15600,"map":{"name":"Развязка"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":60000},{"item":{"name":"Балаклава Призрак","description":"Балаклава с рисунком черепа. Выглядит опасно.","iconLink":"https://assets.tarkov.dev/5ab8f4ff86f77431c60d91ba-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5ab8f4ff86f77431c60d91ba-image.webp"},"count":2}]}}';
        $baraholshik->url = 'baraholshik-quests';

        $this->assertTrue($baraholshik->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление */
    public function testUpdate()
    {
        $baraholshik = Tasks::find()->where(['is not', 'id', null])->one();

        $baraholshik->quest = 'Первый квест333';
        $baraholshik->trader_name = 'Барахольщик222';
        $baraholshik->trader_icon = 'https://assets.tarkov.dev/5ac3b934156ae10c443034343434e83c.webp';
        $baraholshik->json = '{"name":"Секрет успеха","factionName":"Any","minPlayerLevel":26,"objectives":[{"type":"findQuestItem","description":"Найти Книгу о технологии изготовления одежды - Часть 1 на Развязке","optional":false},{"type":"giveQuestItem","description":"Передать первую книгу","optional":false},{"type":"findQuestItem","description":"Найти Книгу о технологии изготовления одежды - Часть 2 на Развязке","optional":false},{"type":"giveQuestItem","description":"Передать вторую книгу","optional":false}],"neededKeys":[],"taskRequirements":[{"task":{"name":"Шить - не тужить - Часть 2"},"status":["complete"]}],"experience":15600,"map":{"name":"Развязка"},"trader":{"name":"Барахольщик","imageLink":"https://assets.tarkov.dev/5ac3b934156ae10c4430e83c.webp"},"restartable":false,"startRewards":{"items":[]},"finishRewards":{"items":[{"item":{"name":"Рубли","description":"Несколько банкнот пока еще котирующихся российских рублей.","iconLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5449016a4bdc2d6f028b456f-image.webp"},"count":60000},{"item":{"name":"Балаклава Призрак","description":"Балаклава с рисунком черепа. Выглядит опасно.","iconLink":"https://assets.tarkov.dev/5ab8f4ff86f77431c60d91ba-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5ab8f4ff86f77431c60d91ba-image.webp"},"count":2}]}}';
        $baraholshik->url = 'baraholshik-quests';

        $this->assertIsInt($baraholshik->update(), 'Ожидался int, вернулся false - объект не удалился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $baraholshik = Tasks::find()->one();

        $this->assertNotNull($baraholshik, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $baraholshik = Tasks::find()->all();

        $this->assertTrue(count($baraholshik) == 4, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $baraholshik = Tasks::find()->one()->delete();

        $this->assertIsInt($baraholshik, 'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $baraholshik = Tasks::deleteAll();

        $this->assertIsInt($baraholshik, 'Удаление объекта не случилось, а должно было.');
    }
}