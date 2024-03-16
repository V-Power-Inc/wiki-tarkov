<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 18.12.2023
 * Time: 22:14
 */

namespace app\tests;

use app\models\Catskills;
use app\common\helpers\validators\StringValidator;
use tests\_support\FixturesCollection;
use UnitTester;

/**
 * UNIT тестирование Active Record модели категорий для справочника умений
 *
 * Class CatskillsTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class CatskillsTest extends \Codeception\Test\Unit
{
    /** Объект класса для тестирования */
    protected UnitTester $tester;

    /** Метод выполняется перед каждым тестом */
    public function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures(FixturesCollection::getSkillsWithCats());
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
        $list = [];

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
        $list = [Catskills::ATTR_ID, Catskills::ATTR_SORTIR, Catskills::ATTR_ENABLED];

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
        $list_main = [Catskills::ATTR_TITLE, Catskills::ATTR_DESCRIPTION, Catskills::ATTR_URL, Catskills::ATTR_KEYWORDS];

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
    public function testCreation()
    {
        /** Создаем новый объект AR */
        $item = new Catskills();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($item);

        /** Значения на сохранение нового объекта */
        $values = [
            Catskills::ATTR_ID => 4,
            Catskills::ATTR_TITLE => 'Основная категория',
            Catskills::ATTR_URL => 'main-category3', // Констраинт на Unique в БД
            Catskills::ATTR_CONTENT => '<p>Описание новой основной категории</p>',
            Catskills::ATTR_DESCRIPTION => 'Seo описание новой основной категории',
            Catskills::ATTR_KEYWORDS => 'Основная категория, лут, тесты',
            Catskills::ATTR_SORTIR => 1,
            Catskills::ATTR_ENABLED => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $item->setAttributes($values);

        /** Валидируем атрибуты */
        $item->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($item->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Catskills::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Catskills::findOne([Catskills::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($item);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Catskills::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем выборку только активных записей */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи - только среди активных */
        $list = Catskills::find()->where([Catskills::ATTR_ENABLED => Catskills::TRUE])->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Выбираем 1 запись - только среди активных и с определенным урлом */
    public function testSelectSingleActiveRowByUrl()
    {
        /** Ищем одну активную запись по урлу */
        $item = Catskills::find()
            ->where([Catskills::ATTR_URL => 'mental'])
            ->andWhere([Catskills::ATTR_ENABLED => Catskills::TRUE])
            ->one();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем выборку только отключенных записей */
    public function testSelectDisabledRows()
    {
        /** Выбираем все записи - только среди активных */
        $list = Catskills::find()->where([Catskills::ATTR_ENABLED => Catskills::FALSE])->all();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Catskills::findOne([Catskills::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Catskills::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}