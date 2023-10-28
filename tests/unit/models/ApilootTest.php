<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 28.10.2023
 * Time: 23:59
 */

namespace models;

use app\models\ApiLoot;
use app\tests\fixtures\ApilootFixture;

/**
 * Unit тесты для API страниц актуального лута
 *
 * Class ApilootTest
 * @package models
 */
class ApilootTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблицы api_loot
     * @return array
     */
    public function _fixtures()
    {
        return [
            'api_loot' => [
                'class' => ApilootFixture::class,
                'dataFile' => codecept_data_dir() . 'api-loot.php'
            ]
        ];
    }


    /** Тестируем создание */
    public function testCreate()
    {
        $loot = new ApiLoot();

        $loot->name = 'M4A1-Автомат';
        $loot->json = '{"id":"5ae30e795acfc408fb139a0b","name":"Мушка-газблок для M4A1","normalizedName":"m4a1-front-sight-with-gas-block","width":1,"height":1,"weight":0.15,"description":"Штатная мушка для M4A1, производство Colt.","category":{"name":"Газовый блок"},"iconLink":"https://assets.tarkov.dev/5ae30e795acfc408fb139a0b-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5ae30e795acfc408fb139a0b-image.webp","sellFor":[{"vendor":{"name":"Прапор"},"price":1285,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1285},{"vendor":{"name":"Скупщик"},"price":1028,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1028},{"vendor":{"name":"Лыжник"},"price":1259,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1259},{"vendor":{"name":"Миротворец"},"price":9,"currency":"USD","currencyItem":{"name":"Доллары"},"priceRUB":1156},{"vendor":{"name":"Механик"},"price":1439,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1439},{"vendor":{"name":"Барахолка"},"price":20000,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":20000}],"buyFor":[{"vendor":{"name":"Миротворец"},"price":21,"currency":"USD","currencyItem":{"name":"Доллары"},"priceRUB":3125},{"vendor":{"name":"Барахолка"},"price":26255,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":26255}],"bartersFor":[],"receivedFromTasks":[{"name":"Друг с Запада - Часть 1","trader":{"name":"Лыжник"}}]}';
        $loot->url  = 'm4a1';
        $loot->active = 1;

        $this->assertTrue($loot->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление */
    public function testUpdate()
    {
        $loot = ApiLoot::find()->where(['is not', 'id', null])->one();

        $loot->name = 'AK74';
        $loot->json = '{"id":"5ae30e795acfc408fb139a0b","name":"Переименованное название","normalizedName":"m4a1-front-sight-with-gas-block","width":1,"height":1,"weight":0.15,"description":"Штатная мушка для M4A1, производство Colt.","category":{"name":"Газовый блок"},"iconLink":"https://assets.tarkov.dev/5ae30e795acfc408fb139a0b-icon.webp","inspectImageLink":"https://assets.tarkov.dev/5ae30e795acfc408fb139a0b-image.webp","sellFor":[{"vendor":{"name":"Прапор"},"price":1285,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1285},{"vendor":{"name":"Скупщик"},"price":1028,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1028},{"vendor":{"name":"Лыжник"},"price":1259,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1259},{"vendor":{"name":"Миротворец"},"price":9,"currency":"USD","currencyItem":{"name":"Доллары"},"priceRUB":1156},{"vendor":{"name":"Механик"},"price":1439,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":1439},{"vendor":{"name":"Барахолка"},"price":20000,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":20000}],"buyFor":[{"vendor":{"name":"Миротворец"},"price":21,"currency":"USD","currencyItem":{"name":"Доллары"},"priceRUB":3125},{"vendor":{"name":"Барахолка"},"price":26255,"currency":"RUB","currencyItem":{"name":"Рубли"},"priceRUB":26255}],"bartersFor":[],"receivedFromTasks":[{"name":"Друг с Запада - Часть 1","trader":{"name":"Лыжник"}}]}';
        $loot->url  = 'ak74';
        $loot->active = 1;

        $this->assertIsInt($loot->update(), 'Ожидался int, вернулся false - объект не обновился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $loot = ApiLoot::find()->one();

        $loot->assertNotNull($loot, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $loot = ApiLoot::find()->all();

        $loot->assertTrue(!empty($loot), 'Ожидалось что вернутся объекты, этого не случилось - что-то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $loot = ApiLoot::find()->one()->delete();

        $this->assertIsInt($loot, 'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $loot = ApiLoot::deleteAll();

        $this->assertIsInt($loot, 'Удаление объекта не случилось, а должно было.');
    }
}