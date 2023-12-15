<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 30.08.2022
 * Time: 12:25
 */

namespace models;

use app\models\Category;

/**
 * UNIT тестирование Active Record модели категорий
 * для справочника лута
 *
 * Class CategoryTest
 * @package models
 */
class CategoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
    }

    /** Метод выполняется после каждого теста */
    protected function _after()
    {}

    /** Тестируем создание основной категории */
    public function testCreateParentCategory()
    {
        $category = new Category();

        $category->id = 3;
        $category->title = 'Основная категория';
        $category->parent_category = null;
        $category->url = 'main-category3'; // Constraint on this field
        $category->content = '<p>Описание новой основной категории</p>';
        $category->description = 'Seo описание новой основной категории';
        $category->keywords = 'Основная категория, лут, тесты';
        $category->sortir = 1;

        $this->assertTrue($category->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем создание дочерней категории с привязкой к родительской */
    public function testCreateChildCategory()
    {
        $category = new Category();

        $category->id = 4;
        $category->title = 'Дочерняя категория';
        $category->parent_category = 3;
        $category->url = 'child-category';
        $category->content = '<p>Описание дочерней категории</p>';
        $category->description = 'Seo описание дочерней категории';
        $category->keywords = 'Дочерняя категория, лут, тесты';
        $category->sortir = 2;

        $this->assertTrue($category->save(), 'Ожидалось true, вернулось false - объект не сохранился.');
    }

    /** Тестируем обновление категории */
    public function testUpdate()
    {
        $category = Category::find()->where(['url' => 'child-category'])->one();

        $category->title = 'Дочерняя категория - updated';
        $category->parent_category = 1;
        $category->url = 'child-category-updated';
        $category->content = '<p>Описание дочерней категории - updated</p>';
        $category->description = 'Seo описание дочерней категории - updated';
        $category->keywords = 'Дочерняя категория, лут, тесты - updated';
        $category->sortir = 2;

        $this->assertIsInt($category->update(), 'Ожидался int, вернулся false - объект не обновился.');
    }

    /** Тестируем получение объекта (select) */
    public function testSelect()
    {
        $category = Category::find()->one();

        $this->assertNotNull($category, 'Ожидался объект, вернулся null - объект не селектнулся.');
    }

    /** Тестируем получение всех объектов (select all) */
    public function testSelectAll()
    {
        $category = Category::find()->all();

        $this->assertTrue(count($category) > 0, 'Ожидалось что вернется больше 2-х объектов, что то пошло не так');
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        $category = Category::find()->one()->delete();

        $this->assertIsInt($category,'Удаление объекта не случилось, а должно было.');
    }

    /** Тестируем удаление всех объектов */
    public function testDeleteAll()
    {
        $category = Category::deleteAll();

        $this->assertIsInt($category,'Удаление объекта не случилось, а должно было.');
    }
}