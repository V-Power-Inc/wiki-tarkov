<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 16.12.2023
 * Time: 14:24
 */

namespace app\tests;

use app\models\Doorkeys;
use app\common\helpers\validators\StringValidator;
use tests\_support\FixturesCollection;
use UnitTester;

/**
 * Unit тесты ключей от дверей
 *
 * Class DoorkeysTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class DoorkeysTest extends \Codeception\Test\Unit
{
    /** Объект класса для тестирования */
    protected UnitTester $tester;

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures(FixturesCollection::getDoorkeys());
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
        $list = [Doorkeys::ATTR_NAME,Doorkeys::ATTR_DESCRIPTION,Doorkeys::ATTR_KEYWORDS];

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
        $list = [Doorkeys::ATTR_ID,Doorkeys::ATTR_ACTIVE];

        /** Проходим в цикле список атрибутов */
        foreach ($list as $item) {

            /** Пробуем засетапить в числовой атрибут - строку */
            $this->_validateAttribute($model, $item, 'a');
        }
    }

    /** Метод для валидации строковых атрибутов */
    protected function _validateStringAttributes($model)
    {
        /** Список атрибутов на валидацию - длина 100 символов */
        $list_hundred = [Doorkeys::ATTR_PREVIEW];
        
        /** Список атрибутов на валидацию - длина 255 символов */
        $list = [Doorkeys::ATTR_NAME];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 101 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH_HUNDRED + 1; $i++) {
            $too_long_string .= 'a';
        }

        /** Проходим в цикле список атрибутов - длина строки 101 символов */
        foreach ($list_hundred as $item) {

            /** Валидируем каждый из них */
            $this->_validateAttribute($model, $item, $too_long_string);
        }

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
        $task = new Doorkeys();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($task);

        /** Значения на сохранение нового объекта */
        $values = [
            Doorkeys::ATTR_ID => 4,
            Doorkeys::ATTR_NAME => 'Новый ключ',
            Doorkeys::ATTR_URL => 'test_key_url',
            Doorkeys::ATTR_PREVIEW => '/img/item/test.png',
            Doorkeys::ATTR_CONTENT => '<p>New content about key</p>',
            Doorkeys::ATTR_SHORTCONTENT => '<p>New Desc about content on page</p>',
            Doorkeys::ATTR_ACTIVE => 1,
            Doorkeys::ATTR_DESCRIPTION => 'Seo Description',
            Doorkeys::ATTR_KEYWORDS => 'Seo keywords, Test Keywords',
            Doorkeys::ATTR_MAPGROUP => ['Лес', 'Ключи от сейфов/помещений с сейфами']
        ];

        /** Сетапим атрибуты AR объекту */
        $task->setAttributes($values);

        /** Валидируем атрибуты */
        $task->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($task->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Doorkeys::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $task = Doorkeys::findOne([Doorkeys::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($task);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Doorkeys::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем выборку записей - только активные ключи */
    public function testSelectActiveRows()
    {
        /** Выбираем все записи */
        $list = Doorkeys::find()->where([Doorkeys::ATTR_ACTIVE => Doorkeys::TRUE])->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }

    /** Тестируем выборку записей - только активные ключи из определенной группы */
    public function testSelectActiveRowsByGroup()
    {
        /** Выбираем все записи */
        $list = Doorkeys::find()
            ->andWhere(['like', Doorkeys::ATTR_MAPGROUP, 'Лес'])
            ->andWhere([Doorkeys::ATTR_ACTIVE => Doorkeys::TRUE])
            ->orderby([Doorkeys::ATTR_NAME => SORT_STRING])
            ->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем выборку записей - только активные ключи из определенной группы */
    public function testSelectActiveSingleRowByUrl()
    {
        /** Выбираем одну активную запись по урлу */
        $list = Doorkeys::find()
            ->andWhere([Doorkeys::ATTR_URL => 'zb-014'])
            ->andWhere([Doorkeys::ATTR_ACTIVE => Doorkeys::TRUE])
            ->one();

        /** Ожидаем получить из фикстур - 1 запись */
        $this->assertTrue(!empty($list));
    }

    /** Тестируем выборку записей - только деактивированные записи */
    public function testSelectDisabledRows()
    {
        /** Выбираем все записи */
        $list = Doorkeys::find()
            ->andWhere([Doorkeys::ATTR_ACTIVE => Doorkeys::FALSE])
            ->all();

        /** Ожидаем получить из фикстур - 1 записи */
        $this->assertTrue(count($list) == 1);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $item = Doorkeys::findOne([Doorkeys::ATTR_ID => 3]);

        /** Удаляем запись */
        $item->delete();

        /** Получаем список всех записей */
        $list = Doorkeys::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}