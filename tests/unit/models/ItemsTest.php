<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 30.08.2022
 * Time: 12:41
 */

namespace models;

use app\models\Items;
use app\tests\fixtures\CategoryFixture;

/**
 * UNIT тестирование модели справочника лута
 *
 * Class ItemsTest
 * @package models
 */
class ItemsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * Фикстуры для таблиц items и category
     * @return array
     */
    public function _fixtures() {
        return [
            'category' => [
                'class' => CategoryFixture::class,
                'dataFile' => codecept_data_dir() . 'category.php'
            ]
        ];
    }

    /** Тестируем создание нового предмета в справочник лута */
    public function testCreate()
    {
        $item = new Items();

        $item->title = 'Тестовый предмет справочника лута';
        $item->preview = '/item/preview.png';
        $item->shortdesc = 'Короткое описание предмета справочника в списке категорий';
        $item->content = '<p>Детальное содержание объекта лута - тут выводится все содержимое</p>';
        $item->url = 'test-loot';
        $item->description = 'Seo описание карточки лута';
        $item->keywords = 'Seo ключевые слова лута';
        $item->parentcat_id = 1;
        $item->active = 1;
        $item->quest_item = 0;
        $item->trader_group = null;
        $item->search_words = 'Тест, синоним, оригинал';
        $item->module_weapon = null;
        $item->creator = 'PC_Principal';

        $this->assertTrue($item->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление элемента справочника лута */
    public function testUpdate()
    {
        $item = Items::find()->where(['title' => 'Тестовый предмет справочника лута'])->one();

        $item->title = 'Тестовый предмет справочника лута - updated';
        $item->preview = '/item/preview-updated.png';
        $item->shortdesc = 'Короткое описание предмета справочника в списке категорий - updated';
        $item->content = '<p>Детальное содержание объекта лута - тут выводится все содержимое - updated</p>';
        $item->url = 'test-loot-updated';
        $item->description = 'Seo описание карточки лута - updated';
        $item->keywords = 'Seo ключевые слова лута - updated';
        $item->parentcat_id = 2;
        $item->active = 0;
        $item->quest_item = 0;
        $item->trader_group = null;
        $item->search_words = 'Тест, синоним, оригинал - updated';
        $item->module_weapon = null;
        $item->creator = 'KondorMax';

        $this->assertIsInt($item->update(), 'Ожидался int, вернулся false - объект не обновился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $item = Items::find()->one();

        $this->assertNotNull($$item, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $item = Items::find()->all();

        $this->assertTrue(count($item) == 1, 'Ожидалось что вернется 3 объекта, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $item = Items::find()->one()->delete();

        $this->assertIsInt($item,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $item = Items::deleteAll();

        $this->assertIsInt($item,'Удаление объекта не случилось, а должно было.');
    }

}