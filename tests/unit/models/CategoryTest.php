<?php
/**
 * Created by PhpStorm
 * User: PC_Principal
 * Date: 30.08.2022
 * Time: 12:25
 */

namespace app\tests;

use app\models\Category;
use app\tests\fixtures\CategoryFixture;
use app\tests\fixtures\ItemsFixture;
use app\common\helpers\validators\StringValidator;

/**
 * UNIT тестирование Active Record модели категорий для справочника лута
 *
 * Class CategoryTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class CategoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** Метод выполняется перед каждым тестом */
    public function _before()
    {
        /** Грузим фикстуры перед каждым тестом (Фикстура категории) */
        $this->tester->haveFixtures([
            'category' => [
                'class' => CategoryFixture::class,
                'dataFile' => codecept_data_dir() . 'category.php'
            ],
            'items' => [
                'class' => ItemsFixture::class,
                'dataFile' => codecept_data_dir() . 'items.php'
            ]
        ]);
    }

    /** Метод выполняется после каждого теста */
    protected function _after()
    {}

    /**
     * Метод вызывающий валидации атрибутов различных типов
     */
    protected function _validateAttributes($model)
    {
        /** Валидация обязательных атрибутов */
        $this->_validateRequiredAttributes($model);

        /** Валидация строковых атрибутов */
        $this->_validateStringAttributes($model);

        /** Валидация числовых атрибутов */
        $this->_validateNumberAttributes($model);
    }

    /** Метод для валидации обязательных атрибутов */
    protected function _validateRequiredAttributes($model)
    {
        /** Список атрибутов на валидацию */
        $list = [Category::ATTR_TITLE, Category::ATTR_DESCRIPTION, Category::ATTR_SORTIR, Category::ATTR_URL];

        /** Проходим в цикле список атрибутов */
        foreach ($list as $item) {

            /** Пробуем оставить их как null */
            $this->_validateAttribute($model, $item, null);
        }
    }

    /** Метод для валидации числовых атрибутов */
    protected function _validateNumberAttributes($model)
    {
        /** Список атрибутов на валидацию */
        $list = [Category::ATTR_ID, Category::ATTR_SORTIR, Category::ATTR_ENABLED, Category::ATTR_PARENT_CATEGORY];

        /** Проходим в цикле список атрибутов */
        foreach ($list as $item) {

            /** Пробуем засетапить в числовой атрибут - строку */
            $this->_validateAttribute($model, $item, 'a');
        }
    }

    /** Метод для валидации строковых атрибутов */
    protected function _validateStringAttributes($model)
    {
        /** Список атрибутов на валидацию - длина 255 символов */
        $list_main = [Category::ATTR_TITLE, Category::ATTR_DESCRIPTION, Category::ATTR_URL, Category::ATTR_KEYWORDS];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 256 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 256 символов */
        foreach ($list_main as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
        }
    }

    /** Метод валидации атрибута, что сюда передается */
    protected function _validateAttribute($model, $attribute, $value)
    {
        /** Сетапим значение атрибута AR модели */
        $model->setAttribute($attribute, $value);

        /** Ожидаем что атрибут не пройдет валидацию */
        $this->assertFalse($model->validate($attribute), $attribute . ': ' . $value);
    }

    /** Тестируем создание основной категории */
    public function testCreationParentCategory()
    {
        /** Создаем новый объект AR */
        $item = new Category();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Category::ATTR_ID => 4,
            Category::ATTR_TITLE => 'Основная категория',
            Category::ATTR_PARENT_CATEGORY => null,
            Category::ATTR_URL => 'main-category3', // Констраинт на Unique в БД
            Category::ATTR_CONTENT => '<p>Описание новой основной категории</p>',
            Category::ATTR_DESCRIPTION => 'Seo описание новой основной категории',
            Category::ATTR_KEYWORDS => 'Основная категория, лут, тесты',
            Category::ATTR_SORTIR => 1,
            Category::ATTR_ENABLED => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Category::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем создание дочерней категории с привязкой к родительской */
    public function testCreateChildCategory()
    {
        /** Создаем новый объект AR */
        $item = new Category();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Category::ATTR_ID => 5,
            Category::ATTR_TITLE => 'Дочерняя категория',
            Category::ATTR_PARENT_CATEGORY => 1,
            Category::ATTR_URL => 'child-category', // Констраинт на Unique в БД
            Category::ATTR_CONTENT => '<p>Описание дочерней категории</p>',
            Category::ATTR_DESCRIPTION => 'Seo описание дочерней категории',
            Category::ATTR_KEYWORDS => 'Дочерняя категория, лут, тесты',
            Category::ATTR_SORTIR => 2,
            Category::ATTR_ENABLED => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Category::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }
    
    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Category::findOne([Category::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Category::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем получение всех записей - только активных(select) */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи */
        $list = Category::find()
            ->where([Category::ATTR_ENABLED => Category::TRUE])
            ->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем получение одной активной категории по урлу */
    public function testSelectSingleActiveRowByUrl()
    {
        /** Выбираем одну активную запись по урлу */
        $list = Category::find()
            ->where([Category::ATTR_URL => 'main-category-second'])
            ->andWhere([Category::ATTR_ENABLED => Category::TRUE])
            ->one();

        /** Ожидаем что у категории есть активная запись по урлу */
        $this->assertTrue(!empty($list));
    }

    /** Тестируем получение всех записей - только неактивных (select) */
    public function testSelectDisabledRows()
    {
        /** Выбираем все записи - только не активные */
        $list = Category::find()
            ->where([Category::ATTR_ENABLED => Category::FALSE])
            ->all();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем получение одной неактивной категории по урлу */
    public function testSelectSingleDisabledRowByUrl()
    {
        /** Выбираем одну активную запись по урлу и неактивную */
        $list = Category::find()
            ->where([Category::ATTR_URL => 'main-category-thirdd'])
            ->andWhere([Category::ATTR_ENABLED => Category::FALSE])
            ->one();

        /** Ожидаем что у категории есть активная запись по урлу */
        $this->assertTrue(!empty($list));
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Category::findOne([Category::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Category::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}