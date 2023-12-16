<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 13:40
 */

namespace app\tests;

use app\models\Currencies;
use app\tests\fixtures\CurrenciesFixture;
use app\common\helpers\validators\StringValidator;

/**
 * Unit тесты валют EFT
 *
 * Class CurrenciesTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class CurrenciesTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures([
            'currencies' => [
                'class' => CurrenciesFixture::class,
                'dataFile' => codecept_data_dir() . 'currencies.php'
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
        $list = [Currencies::ATTR_ID, Currencies::ATTR_VALUE, Currencies::ATTR_ENABLED];

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
        $list = [Currencies::ATTR_TITLE];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 256 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 256 символов */
        foreach ($list as $item) {

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

    /** Тестируем создание нового объекта */
    public function testCreation()
    {
        /** Создаем новый AR объект  */
        $task = new Currencies();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($task);

        /** Значения на сохранение нового объекта */
        $values = [
            Currencies::ATTR_ID => 4,
            Currencies::ATTR_TITLE => 'Новый объект валюты',
            Currencies::ATTR_VALUE => 10000,
            Currencies::ATTR_ENABLED => 1
        ];

        /** Сетапим атрибуты AR объекту */
        $task->setAttributes($values);

        /** Валидируем атрибуты */
        $task->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($task->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Currencies::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $task = Currencies::findOne([Currencies::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($task);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Currencies::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }


    /** Тестируем выборку только среди активных записей */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи */
        $list = Currencies::find()->where([Currencies::ATTR_ENABLED => 1])->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Выбираем только 1 активную запись - курс доллара */
    public function testSelectDollarRow()
    {
        /** Выбираем 1 запись по критерию */
        $item = Currencies::find()
            ->where([Currencies::ATTR_TITLE => 'Доллар'])
            ->andWhere([Currencies::ATTR_ENABLED => 1])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(!empty($item));
    }

    /** Выбираем только 1 активную запись - курс евро */
    public function testSelectEuroRow()
    {
        /** Выбираем 1 запись по критерию */
        $item = Currencies::find()
            ->where([Currencies::ATTR_TITLE => 'Евро'])
            ->andWhere([Currencies::ATTR_ENABLED => 1])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(!empty($item));
    }

    /** Выбираем только 1 активную запись - курс биткоина */
    public function testSelectBitkoinRow()
    {
        /** Выбираем 1 запись по критерию */
        $item = Currencies::find()
            ->where([Currencies::ATTR_TITLE => 'Биткоин'])
            ->andWhere([Currencies::ATTR_ENABLED => 1])
            ->all();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(!empty($item));
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Currencies::findOne([Currencies::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Currencies::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}