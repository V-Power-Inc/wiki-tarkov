<?php
/**
 * Created by PhpStorm.
 * User: PC_Principal
 * Date: 29.02.2024
 * Time: 20:46
 */

namespace app\tests;

use app\models\Patrons;
use app\common\helpers\validators\StringValidator;
use tests\_support\FixturesCollection;
use UnitTester;

/**
 * Unit тесты таблицы патронов и их атрибутов
 *
 * Class PatronsTest
 * @package models
 *
 * @see https://codeception.com/docs/UnitTests
 * @see https://www.yiiframework.com/doc/guide/2.0/ru/test-fixtures
 */
class PatronsTest extends \Codeception\Test\Unit
{
    /** Объект класса для тестирования */
    protected UnitTester $tester;

    /** Метод выполняется перед каждым тестом */
    protected function _before()
    {
        /** Грузим фикстуры перед каждым тестом */
        $this->tester->haveFixtures(FixturesCollection::getPatrons());
    }

    /** Метод выполняется после каждого теста */
    protected function _after()
    {}

    /**
     * Метод вызывающий валидации атрибутов различных типов
     */
    protected function _validateAttributes($model)
    {
        /** Валидация строковых атрибутов */
        $this->_validateStringAttributes($model);

        /** Валидация числовых атрибутов */
        $this->_validateNumberAttributes($model);
    }

    /** Метод для валидации числовых атрибутов */
    protected function _validateNumberAttributes($model)
    {
        /** Список атрибутов на валидацию */
        $list = [Patrons::ATTR_ID];

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
        $list = [
            Patrons::ATTR_CALIBER,
            Patrons::ATTR_TYPE,
            Patrons::ATTR_DAMAGE,
            Patrons::ATTR_PROBITIE,
            Patrons::ATTR_DAMAGE_PER_DEFENCE,
            Patrons::ATTR_SPEED,
            Patrons::ATTR_COUNT,
            Patrons::ATTR_TOCHN,
            Patrons::ATTR_OTDACHA,
            Patrons::ATTR_FRAGMENTATION,
            Patrons::ATTR_BLOOD_1,
            Patrons::ATTR_BLOOD_2,
            Patrons::ATTR_RIKOCHET,
            Patrons::ATTR_TRACCER,
            Patrons::ATTR_YB
        ];

        /** Переменная с пустой строкой */
        $too_long_string = '';

        /** В цикле увеличиваем длину строки, пока не станет 101 символов */
        for ($i = 0; $i < StringValidator::VARCHAR_LENGTH_HUNDRED + 1; $i++) {
            $too_long_string .= 'a';
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
        $patron = new Patrons();

        /** Валидируем все атрибуты AR объекта*/
        $this->_validateAttributes($patron);

        /** Значения на сохранение нового объекта */
        $values = [
            Patrons::ATTR_ID => 4,
            Patrons::ATTR_CALIBER => '9x19 мм',
            Patrons::ATTR_TYPE => 'Пст гж',
            Patrons::ATTR_DAMAGE => '54',
            Patrons::ATTR_PROBITIE => '20',
            Patrons::ATTR_DAMAGE_PER_DEFENCE => '33',
            Patrons::ATTR_SPEED => '457',
            Patrons::ATTR_COUNT => '1',
            Patrons::ATTR_TOCHN => '—',
            Patrons::ATTR_OTDACHA => '—',
            Patrons::ATTR_FRAGMENTATION => '15%',
            Patrons::ATTR_BLOOD_1 => '17%',
            Patrons::ATTR_BLOOD_2 => '—',
            Patrons::ATTR_RIKOCHET => '5%',
            Patrons::ATTR_TRACCER => '—',
            Patrons::ATTR_YB => '22'
        ];

        /** Сетапим атрибуты AR объекту */
        $patron->setAttributes($values);

        /** Валидируем атрибуты */
        $patron->validate();

        /** Ожидаем что запись сохранилась */
        $this->assertTrue($patron->save(), 'Ожидалось true - объект не сохранился.');

        /** Выбираем все записи */
        $list = Patrons::find()->all();

        /** Ожидаем что всего будет 4 записи */
        $this->assertTrue(count($list) == 4);
    }

    /** Тестируем выборку записи на обновление */
    public function testEdit()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $patron = Patrons::findOne([Patrons::ATTR_ID => 3]);

        /** Проводит валидацию атрибутов данных, полученных из фикстуры */
        $this->_validateAttributes($patron);
    }

    /** Тестируем получение всех записей (select) */
    public function testList()
    {
        /** Выбираем все записи */
        $list = Patrons::find()->all();

        /** Ожидаем получить из фикстур - 3 записи */
        $this->assertTrue(count($list) == 3);
    }

    /** Тестируем удаление объекта */
    public function testDelete()
    {
        /** Выбираем одну из записей, представленных в фикстурах */
        $patron = Patrons::findOne([Patrons::ATTR_ID => 3]);

        /** Удаляем запись */
        $patron->delete();

        /** Получаем список всех записей */
        $list = Patrons::find()->all();

        /** Ожидаем получить из фикстур - 2 записи */
        $this->assertTrue(count($list) == 2);
    }
}